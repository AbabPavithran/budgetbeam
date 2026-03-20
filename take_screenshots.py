import time
import random
from playwright.sync_api import sync_playwright

def run():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()
        page.set_viewport_size({"width": 1366, "height": 768})
        
        # 1. Capture Login UI
        try:
            print("Navigating to login...")
            page.goto("http://127.0.0.1:8000/login")
            time.sleep(2)
            page.screenshot(path="Budgetbeam_FSD_Report/login_ui.png")
            print("Saved login_ui.png")
        except Exception as e:
            print("Failed to capture login:", e)

        # 2. Register to access Dashboard
        try:
            print("Navigating to register...")
            page.goto("http://127.0.0.1:8000/register")
            time.sleep(1)
            rand_id = random.randint(10000, 99999)
            page.fill("input[name='name']", "Report Admin")
            page.fill("input[name='email']", f"admin{rand_id}@budgetbeam.test")
            page.fill("input[name='password']", "password123")
            page.fill("input[name='password_confirmation']", "password123")
            
            # Click the button (no type='submit' explicitly defined)
            page.click("button.btn-primary")
            
            print("Waiting for dashboard...")
            page.wait_for_url("**/dashboard", timeout=15000)
            time.sleep(4) # Wait for dashboard charts and animations
            page.screenshot(path="Budgetbeam_FSD_Report/dashboard_ui.png", full_page=True)
            print("Saved dashboard_ui.png")
            
        except Exception as e:
            print("Failed to capture dashboard:", e)
            
        browser.close()

if __name__ == "__main__":
    run()
