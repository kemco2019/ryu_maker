import base64
import os
import requests
import datetime
import sys
from PIL import Image
import urllib.request

img_url = sys.argv[1]
prompt = "A painting of a dragon"
engine_id = "stable-diffusion-xl-1024-v1-0"
api_host = "https://api.stability.ai"
api_key = "YOUR_API_KEY"

dst_path = 'ryu-style.jpg'
urllib.request.urlretrieve(img_url, dst_path)
init_img = dst_path

## Resize init_img (1024,1024)
def crop_center(pil_img):
    img_width, img_height = pil_img.size
    if img_width < img_height:
        crop = img_width
    else:
        crop = img_height
    return pil_img.crop(((img_width - crop) // 2,
                         (img_height - crop) // 2,
                         (img_width + crop) // 2,
                         (img_height + crop) // 2))
im = Image.open(init_img)
im_crop = crop_center(im)
im_new = im_crop.resize((1024,1024))
im_new.save(f'init.png')

## Dream Studio
response = requests.post(
    f"{api_host}/v1/generation/{engine_id}/image-to-image",
    headers={
        "Accept": "application/json",
        "Authorization": f"Bearer {api_key}"
    },
    files={
        "init_image": open("init.png", "rb")
    },
    data={
        "image_strength": 0.35,
        "init_image_mode": "IMAGE_STRENGTH",
        "text_prompts[0][text]": prompt,
        "cfg_scale": 7,
        "samples": 1,
        "steps": 30,
    }
)

if response.status_code != 200:
    raise Exception("Non-200 response(" + str(response.status_code) + "):" + str(response.text))

data = response.json()
now = datetime.datetime.now().strftime('%Y%m%d_%H%M%S')
for i, image in enumerate(data["artifacts"]):
    with open('output/base64.txt', mode='w') as f:
        f.write(image["base64"])
    with open(f"./output/{now}.png", "wb") as f:
        f.write(base64.b64decode(image["base64"]))
