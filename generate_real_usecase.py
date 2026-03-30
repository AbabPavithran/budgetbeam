import base64
import zlib
import requests

puml = """
@startuml
left to right direction
skinparam packageStyle rectangle
skinparam usecase {
  BackgroundColor #EEEEEE
  BorderColor black
}
actor "Guest" as g
actor "User" as u

rectangle "Budgetbeam System" {
  usecase "Register / Login" as UC1
  usecase "Manage Budgets" as UC2
  usecase "Record Expense" as UC3
  usecase "View Analytics" as UC4
  usecase "Export Report" as UC5
  usecase "Manage Categories" as UC6
}

g -- UC1
u -- UC1
u -- UC2
u -- UC3
u -- UC4
u -- UC5
u -- UC6
@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    with open(r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\use_case.png", "wb") as f:
        f.write(response.content)
    with open(r"c:\Users\asus\budgetbeam\real_use_case.png", "wb") as f:
        f.write(response.content)
    print("Diagram successfully generated using Kroki!")
else:
    print(f"Error {response.status_code}: {response.text}")
