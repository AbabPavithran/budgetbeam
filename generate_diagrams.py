import base64
import requests
import json
import os

base_dir = r"c:\Users\asus\budgetbeam\Budgetbeam_FSD_Report"
os.makedirs(base_dir, exist_ok=True)

diagrams = {
    "use_case.png": """flowchart LR
    User([User])
    User --> (Register / Login)
    User --> (Manage Budgets)
    User --> (Record Expense)
    User --> (View Analytics)
    User --> (Export Report)
    User --> (Manage Categories)""",
    
    "activity.png": """stateDiagram-v2
    [*] --> Login
    Login --> Dashboard
    Dashboard --> Click_Add_Expense
    Click_Add_Expense --> Fill_Details
    Fill_Details --> Validate_Data
    Validate_Data --> |Valid| Save_To_DB
    Validate_Data --> |Invalid| Show_Error
    Show_Error --> Fill_Details
    Save_To_DB --> Update_Budget_Remaining
    Update_Budget_Remaining --> Refresh_Dashboard
    Refresh_Dashboard --> [*]""",
    
    "architecture.png": """flowchart TD
    Client[Web Browser / User] -->|HTTP Request| Route[Routes web.php]
    Route --> Controller[Controllers]
    Controller --> Model[Models / Eloquent ORM]
    Model <--> DB[(PostgreSQL Database)]
    Controller -->|Pass Data| View[Blade Views / Tailwind]
    View -->|HTML/CSS/JS| Client""",
    
    "class.png": """classDiagram
    class User {
        +BigInt id
        +String name
        +String email
        +String password
        +register()
        +login()
    }
    class Budget {
        +BigInt id
        +Decimal amount
        +Date start_date
        +Date end_date
        +calculateRemaining()
    }
    class Expense {
        +BigInt id
        +Decimal amount
        +String description
        +Date date
        +logExpense()
    }
    class Category {
        +BigInt id
        +String name
        +String color
    }
    User "1" -- "*" Budget
    User "1" -- "*" Expense
    User "1" -- "*" Category
    Category "1" -- "*" Expense
    Budget "1" -- "*" Expense""",
    
    "er.png": """erDiagram
    USERS ||--o{ BUDGETS : creates
    USERS ||--o{ EXPENSES : logs
    USERS ||--o{ CATEGORIES : owns
    CATEGORIES ||--o{ EXPENSES : categorizes
    BUDGETS ||--o{ EXPENSES : tracks
    USERS {
        bigint id PK
        string name
        string email
    }
    BUDGETS {
        bigint id PK
        bigint user_id FK
        bigint category_id FK
        decimal amount
    }
    EXPENSES {
        bigint id PK
        bigint user_id FK
        bigint category_id FK
        bigint budget_id FK
        decimal amount
    }
    CATEGORIES {
        bigint id PK
        string name
    }""",
    
    "sequence.png": """sequenceDiagram
    actor User
    participant View as Dashboard (Blade)
    participant Controller as ExpenseController
    participant Model as Expense (Eloquent)
    participant DB as PostgreSQL
    
    User->>View: Fills form & clicks Submit
    View->>Controller: POST /expenses
    Controller->>Controller: Validate Input
    Controller->>Model: Expense::create(data)
    Model->>DB: INSERT INTO expenses
    DB-->>Model: Return success
    Model->>Controller: Expense Instance
    Controller-->>View: Redirect with Success Msg
    View-->>User: Show updated Dashboard""",
    
    "pipeline.png": """flowchart LR
    Design[System Design] --> DB[DB Schema]
    DB --> Auth[Auth Setup]
    Auth --> Core[Budgets & Expenses]
    Core --> UI[Dashboard UI]
    UI --> Test[Testing & QA]
    Test --> Deploy[Deploy]"""
}

for filename, mermaid_code in diagrams.items():
    print(f"Generating {filename}...")
    # mermaid.ink uses base64 encoded JSON string
    state = {
        "code": mermaid_code,
        "mermaid": {
            "theme": "default"
        }
    }
    json_str = json.dumps(state)
    b64_str = base64.urlsafe_b64encode(json_str.encode('utf-8')).decode('utf-8')
    url = f"https://mermaid.ink/img/{b64_str}"
    
    try:
        response = requests.get(url)
        if response.status_code == 200:
            with open(os.path.join(base_dir, filename), "wb") as f:
                f.write(response.content)
            print(f"Saved {filename}")
        else:
            print(f"Failed to fetch {filename}: HTTP {response.status_code}")
    except Exception as e:
        print(f"Error fetching {filename}: {str(e)}")

print("Done downloading UML diagrams!")
