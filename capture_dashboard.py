import time
import os
from playwright.sync_api import sync_playwright

WEB_PHP_PATH = "routes/web.php"
BYPASS_ROUTE = "\n\nRoute::get('/screenshot-bypass', function() { \\Illuminate\\Support\\Facades\\Auth::loginUsingId(1); return redirect('/dashboard'); });\n"

def append_route():
    print("Appending bypass route...")
    with open(WEB_PHP_PATH, "a") as f:
        f.write(BYPASS_ROUTE)

def remove_route():
    print("Removing bypass route...")
    with open(WEB_PHP_PATH, "r") as f:
        lines = f.readlines()
    with open(WEB_PHP_PATH, "w") as f:
        for line in lines:
            if "/screenshot-bypass" not in line:
                f.write(line)

def run():
    append_route()
    
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page(viewport={"width": 1366, "height": 768})
        
        try:
            print("Bypassing login to reach dashboard...")
            page.goto("http://127.0.0.1:8000/screenshot-bypass")
            page.wait_for_url("**/dashboard", timeout=10000)
            time.sleep(5)  # Wait for charts to load
            page.screenshot(path="Budgetbeam_FSD_Report/dashboard_ui.png", full_page=True)
            print("Saved dashboard_ui.png")
        except Exception as e:
            print("Failed to capture dashboard:", e)
            
        browser.close()
        
    remove_route()

if __name__ == "__main__":
    run()
