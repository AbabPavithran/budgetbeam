import base64
import zlib
import requests

puml = """
@startuml
skinparam class {
    BackgroundColor #F3F4F6
    ArrowColor #2C3E50
    BorderColor #333333
    FontName Arial
}
skinparam ArrowColor #555555

class User {
  + BigInt id
  + String name
  + String email
  + String password
  + String role
  + Decimal monthly_budget
  + register()
  + login()
  + expenses()
  + wallet()
}

class Expense {
  + BigInt id
  + BigInt user_id
  + String title
  + Decimal amount
  + String category
  + Date expense_date
  + logExpense()
  + user()
}

class Wallet {
  + BigInt id
  + BigInt user_id
  + Decimal balance
  + addFunds()
  + deductFunds()
  + transactions()
  + user()
}

class WalletTransaction {
  + BigInt id
  + BigInt wallet_id
  + Enum type
  + Decimal amount
  + String description
  + recordTransaction()
  + wallet()
}

User "1" -- "*" Expense : "has many"
User "1" -- "1" Wallet : "has one"
Wallet "1" -- "*" WalletTransaction : "has many"

@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    for path in [
        r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\class.png",
        r"c:\Users\asus\budgetbeam\class.png"
    ]:
        try:
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"Saved: {path}")
        except Exception as e:
            print(f"Skipped {path}: {e}")
    print("Class Diagram successfully generated using Kroki!")
else:
    print(f"Error {response.status_code}: {response.text}")
