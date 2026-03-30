import base64
import zlib
import requests

pumls = {
    "seq_login.png": """
@startuml
skinparam maxMessageSize 100
skinparam ParticipantBackgroundColor #F8FAFC
skinparam ParticipantBorderColor #333333
skinparam ActorBackgroundColor #F8FAFC
skinparam ActorBorderColor #333333
skinparam ArrowColor #555555
skinparam DatabaseBackgroundColor #F8FAFC
skinparam DatabaseBorderColor #333333
skinparam FontName Arial

actor "User" as guest
participant "Login UI (Blade)" as ui
participant "AuthController" as controller
participant "User (Eloquent)" as model
database "PostgreSQL" as db

guest -> ui : Enters email/password & clicks Login
ui -> controller : POST /login
controller -> controller : Validates input format
controller -> db : SELECT user WHERE email = ?
db --> controller : Return user record
controller -> controller : Verifies password hash
controller -> model : Generate & Store Session Token
model --> controller : Session authenticated securely
controller --> ui : Redirect to Dashboard
ui --> guest : Displays user Dashboard
@enduml
""",
    "seq_analytics.png": """
@startuml
skinparam maxMessageSize 100
skinparam ParticipantBackgroundColor #F8FAFC
skinparam ParticipantBorderColor #333333
skinparam ActorBackgroundColor #F8FAFC
skinparam ActorBorderColor #333333
skinparam ArrowColor #555555
skinparam DatabaseBackgroundColor #F8FAFC
skinparam DatabaseBorderColor #333333
skinparam FontName Arial

actor "User" as user
participant "Dashboard/Wallet UI" as ui
participant "DashboardController" as controller
participant "Expense/Wallet (Models)" as model
database "PostgreSQL" as db

user -> ui : Opens Dashboard page
ui -> controller : GET /dashboard
controller -> model : Query total monthly expenses/wallet balance
model -> db : SELECT SUM(amount) GROUP BY category
db --> model : Return aggregated metrics
model --> controller : Pass structured visual data
controller --> ui : Render metrics & Chart.js data
ui --> user : Displays interactive charts & balance
@enduml
"""
}

for filename, puml in pumls.items():
    payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
    url = f"https://kroki.io/plantuml/png/{payload}"
    
    response = requests.get(url)
    if response.status_code == 200:
        paths = [
            f"c:\\Users\\asus\\budgetbeam\\{filename}",
            f"c:\\Users\\asus\\budgetbeam\\Budgetbeam_Overleaf_Ready__2__Extracted\\{filename}"
        ]
        for path in paths:
            try:
                with open(path, "wb") as f:
                    f.write(response.content)
            except Exception as e:
                pass
        print(f"Successfully generated {filename}")
    else:
        print(f"Error {response.status_code} on {filename}: {response.text}")
