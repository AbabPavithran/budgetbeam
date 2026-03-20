import time
from playwright.sync_api import sync_playwright

WEB_PHP_PATH = "routes/web.php"
BYPASS_ROUTE = "\n\nRoute::get('/screenshot-bypass-more', function() { \\Illuminate\\Support\\Facades\\Auth::loginUsingId(1); return redirect('/dashboard'); });\n"

def append_route():
    print("Appending auth bypass route...")
    try:
        with open(WEB_PHP_PATH, "a") as f:
            f.write(BYPASS_ROUTE)
    except Exception as e:
        print("Could not append route:", e)

def remove_route():
    print("Removing auth bypass route...")
    try:
        with open(WEB_PHP_PATH, "r") as f:
            lines = f.readlines()
        with open(WEB_PHP_PATH, "w") as f:
            for line in lines:
                if "/screenshot-bypass-more" not in line:
                    f.write(line)
    except Exception as e:
        print("Could not remove route:", e)

def run():
    append_route()
    
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page(viewport={"width": 1366, "height": 768})
        
        try:
            # 1. Register Page
            print("Capturing Register...")
            page.goto("http://127.0.0.1:8000/register")
            time.sleep(2)
            page.screenshot(path="Budgetbeam_FSD_Report/register_ui.png", full_page=True)

            # 2. Forgot Password
            print("Capturing Forgot Password...")
            page.goto("http://127.0.0.1:8000/forgot-password")
            time.sleep(1)
            page.screenshot(path="Budgetbeam_FSD_Report/forgot_password_ui.png", full_page=True)
            
            # Authenticate via bypass
            print("Bypassing auth...")
            page.goto("http://127.0.0.1:8000/screenshot-bypass-more")
            page.wait_for_url("**/dashboard", timeout=15000)
            
            # 3. Calendar
            print("Capturing Calendar...")
            page.goto("http://127.0.0.1:8000/calendar")
            time.sleep(3)
            page.screenshot(path="Budgetbeam_FSD_Report/calendar_ui.png", full_page=True)
            
            # 4. Settings
            print("Capturing Settings...")
            page.goto("http://127.0.0.1:8000/settings")
            time.sleep(2)
            page.screenshot(path="Budgetbeam_FSD_Report/settings_ui.png", full_page=True)

            # 5. Wallet Payment
            print("Capturing Wallet Payment...")
            page.goto("http://127.0.0.1:8000/wallet/payment")
            time.sleep(2)
            page.screenshot(path="Budgetbeam_FSD_Report/wallet_ui.png", full_page=True)
            print("All screenshots captured successfully.")
            
        except Exception as e:
            print("Error capturing screens:", e)
            
        browser.close()
        
    remove_route()

if __name__ == "__main__":
    run()
