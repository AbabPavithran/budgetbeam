import base64
import zlib
import requests

puml = """
@startuml
skinparam maxMessageSize 100
skinparam ParticipantBackgroundColor #F8FAFC
skinparam ParticipantBorderColor #2C3E50
skinparam ActorBackgroundColor #F8FAFC
skinparam ActorBorderColor #2C3E50
skinparam ArrowColor #2C3E50
skinparam DatabaseBackgroundColor #F8FAFC
skinparam DatabaseBorderColor #2C3E50
skinparam FontName Arial

actor "User" as user
participant "Dashboard (Blade)" as dashboard
participant "ExpenseController" as controller
participant "Expense (Eloquent)" as model
database "PostgreSQL" as db

user -> dashboard : Fills form & clicks Submit
dashboard -> controller : POST /expenses
controller -> controller : Validates input
controller -> model : Create new record (data)
model -> db : INSERT INTO expenses
db --> model : Return success
model --> controller : Return instance
controller --> dashboard : Redirect with success Msg
dashboard --> user : Shows updated Dashboard
@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    for path in [
        r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\sequence.png",
        r"c:\Users\asus\budgetbeam\sequence.png"
    ]:
        try:
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"Saved: {path}")
        except Exception as e:
            print(f"Skipped {path}: {e}")
    print("Sequence Diagram successfully generated using Kroki!")
else:
    print(f"Error {response.status_code}: {response.text}")
