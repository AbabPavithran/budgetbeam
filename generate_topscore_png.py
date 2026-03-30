import base64
import zlib
import requests

# This recreates the exact yellow graduation cap on the blue background as a scalable graphic
svg_code = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="640" height="512">
  <rect width="640" height="512" fill="#5c7bda"/>
  <g transform="translate(140, 100) scale(0.6)">
    <path fill="#FFD700" stroke="#d4af37" stroke-width="10" d="M622.3 256.4L355 136.2c-20.9-9.4-44.5-9.4-65.4 0L22.4 256.4c-15.5 6.9-15.5 28.5 0 35.4l41.6 18.7c-1.3 5-2.2 10.3-2.2 15.8v109.1c0 23.3 16.5 44 39.3 49.3 48.7 11.4 105.7 18.2 165.7 18.2s117-6.8 165.7-18.2c22.8-5.3 39.3-26 39.3-49.3V326.3c0-5.5-.9-10.8-2.2-15.8l63-28.3c15.6-6.9 15.6-28.5 0-35.4zm-290-70.8c6.6-2.9 14.1-2.9 20.7 0l183.1 82-183.1 82c-6.6 2.9-14.1 2.9-20.7 0L149.2 267.6l183.1-82zM463.6 407.1c-38.3 11-82.6 11-121.2 0-25.5-7.3-34.5-12.7-34.5-22.3v-54.6l64.2 28.8c18.5 8.3 39.2 8.3 57.7 0l68.2-30.5v72.5c0 9.7-9.1 15-34.4 22.4z"/>
    <path fill="#FFB300" stroke="#d4af37" stroke-width="10" d="M86.5 282.5c4.7 9.8 13.9 16.8 24.6 18.8 10.7 2.1 21.8-.8 29.8-7.9 8-7 12-17.7 10.5-28.4l-12-87 54.4-24.5-98.1-44-67.9 30.4 58.7 142.6z"/>
  </g>
</svg>"""

payload = base64.urlsafe_b64encode(zlib.compress(svg_code.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/svg/png/{payload}"
r = requests.get(url)

if r.status_code == 200:
    path = r"c:\Users\asus\budgetbeam\topscore_logo.png"
    with open(path, "wb") as f:
        f.write(r.content)
    print(f"Topscore logo successfully materialized at {path}!")
else:
    print("Error:", r.text)
