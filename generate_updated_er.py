import base64
import zlib
import requests
import os

puml = """
@startuml
skinparam roundcorner 5
skinparam linetype ortho
skinparam shadowing false
skinparam handwritten false
skinparam class {
    BackgroundColor #F8FAFC
    ArrowColor #2C3E50
    BorderColor #2C3E50
    FontName Arial
}

!define primary_key(x) <b>x</b> (PK)
!define foreign_key(x) <i>x</i> (FK)
!define table(x) entity x << (T, white) >>

table( users ) {
  primary_key( id ): bigint 
  --
  name: string 
  email: string 
  password: string 
  role: string 
  monthly_budget: decimal 
}

table( expenses ) {
  primary_key( id ): bigint 
  --
  foreign_key( user_id ): bigint
  title: string 
  amount: decimal 
  category: string 
  expense_date: date 
}

table( wallets ) {
  primary_key( id ): bigint 
  --
  foreign_key( user_id ): bigint
  balance: decimal 
}

table( wallet_transactions ) {
  primary_key( id ): bigint 
  --
  foreign_key( wallet_id ): bigint
  type: enum 
  amount: decimal 
  description: string
}

users ||--o{ expenses : "logs"
users ||--o| wallets : "owns"
wallets ||--o{ wallet_transactions : "tracks"

@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    paths = [
        r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\er.png",
        r"c:\Users\asus\budgetbeam\er_diagram.png"
    ]
    for path in paths:
        try:
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"Saved: {path}")
        except Exception as e:
            print(f"Error saving {path}: {e}")
    print("ER Diagram successfully generated using Kroki!")
else:
    print(f"Error {response.status_code}: {response.text}")
