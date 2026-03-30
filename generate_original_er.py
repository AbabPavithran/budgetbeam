import base64
import zlib
import requests

puml = """
@startuml
skinparam roundcorner 5
skinparam linetype ortho
skinparam shadowing false
skinparam handwritten false
skinparam class {
    BackgroundColor #F3F4F6
    ArrowColor #2C3E50
    BorderColor #333333
    FontName Arial
}
skinparam ArrowColor #555555

!define primary_key(x) <b>x</b> (PK)
!define foreign_key(x) <i>x</i> (FK)
!define table(x) entity x << (T, white) >>

table( USERS ) {
  primary_key( id ): bigint 
  --
  name: string 
  email: string 
}

table( CATEGORIES ) {
  primary_key( id ): bigint 
  --
  name: string 
}

table( BUDGETS ) {
  primary_key( id ): bigint 
  --
  foreign_key( user_id ): bigint
  foreign_key( category_id ): bigint
  amount: decimal 
}

table( EXPENSES ) {
  primary_key( id ): bigint 
  --
  foreign_key( user_id ): bigint
  foreign_key( category_id ): bigint
  foreign_key( budget_id ): bigint
  amount: decimal 
}

USERS ||--o{ CATEGORIES : "owns"
USERS ||--o{ BUDGETS : "creates"
USERS ||--o{ EXPENSES : "logs"

CATEGORIES ||--o{ EXPENSES : "categorizes"
BUDGETS ||--o{ EXPENSES : "tracks"
@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    path = r"c:\Users\asus\budgetbeam\er_diagram_original.png"
    with open(path, "wb") as f:
        f.write(response.content)
    # Also save to the extracted folder to overwrite the previous one if they are using it
    with open(r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\er.png", "wb") as f:
        f.write(response.content)
    print("ER Diagram matching the original picture successfully generated!")
else:
    print(f"Error {response.status_code}: {response.text}")
