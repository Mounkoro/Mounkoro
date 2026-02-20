from playwright.sync_api import sync_playwright
import time

def verify():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()

        try:
            print("Navigating to 3000...")
            page.goto("http://localhost:3000/register")
            time.sleep(5)
            page.screenshot(path="verification/register.png", full_page=True)
            print("Took screenshot")
        except Exception as e:
            print(f"Error: {e}")

        browser.close()

if __name__ == "__main__":
    verify()
