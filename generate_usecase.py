import base64
import requests
import json
import os

base_dir = r"c:\Users\asus\budgetbeam\Budgetbeam_FSD_Report"
mermaid_code = """flowchart LR
    User([User])
    A([Register / Login])
    B([Manage Budgets])
    C([Record Expense])
    D([View Analytics])
    E([Export Report])
    F([Manage Categories])
    
    User --> A
    User --> B
    User --> C
    User --> D
    User --> E
    User --> F"""

state = {
    "code": mermaid_code,
    "mermaid": {
        "theme": "default"
    }
}
json_str = json.dumps(state)
b64_str = base64.urlsafe_b64encode(json_str.encode('utf-8')).decode('utf-8')
url = f"https://mermaid.ink/img/{b64_str}"

response = requests.get(url)
if response.status_code == 200:
    with open(os.path.join(base_dir, "use_case.png"), "wb") as f:
        f.write(response.content)
    print("Saved use_case.png")
else:
    print(f"Failed to fetch use_case.png: HTTP {response.status_code}")
