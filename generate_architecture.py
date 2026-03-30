import base64
import zlib
import requests

puml = """
@startuml
skinparam componentStyle rectangle
skinparam BackgroundColor white
skinparam component {
  BackgroundColor #F3F4F6
  BorderColor #333333
  FontName Arial
}
skinparam database {
  BackgroundColor #F3F4F6
  BorderColor #333333
  FontName Arial
}
skinparam ArrowColor #444444

component "Web Browser / User" as user
component "Routes web.php" as routes
component "Controllers" as controllers
component "Models / Eloquent ORM" as models
component "Blade Views / Tailwind" as views
database "PostgreSQL Database" as db

user -down-> routes : " HTTP Request "
routes -down-> controllers
controllers -right-> views : " Pass Data "
views -up-> user : " HTML/CSS/JS "

controllers -down-> models
models -up-> controllers
models -down-> db
db -up-> models

@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    for path in [
        r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\architecture.png",
        r"c:\Users\asus\budgetbeam\architecture.png"
    ]:
        try:
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"Saved: {path}")
        except Exception as e:
            print(f"Skipped {path}: {e}")
    print("System Architecture Diagram successfully generated!")
else:
    print(f"Error {response.status_code}: {response.text}")
