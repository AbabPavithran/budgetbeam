import base64
import zlib
import requests

puml = """
@startuml
skinparam activity {
  BackgroundColor #F3F4F6
  BorderColor #333333
  FontName Arial
}
skinparam ArrowColor #555555

start
:Login;
:Dashboard;
:Click_Add_Expense;
label loop_start
:Fill_Details;
:Validate_Data;
if () then ([Invalid])
  :Show_Error;
  goto loop_start
else ([Valid])
  :Save_To_DB;
  :Update_Budget_Remaining;
  :Refresh_Dashboard;
  stop
endif
@enduml
"""

payload = base64.urlsafe_b64encode(zlib.compress(puml.encode('utf-8'))).decode('ascii')
url = f"https://kroki.io/plantuml/png/{payload}"

response = requests.get(url)
if response.status_code == 200:
    for path in [
        r"c:\Users\asus\budgetbeam\Budgetbeam_Overleaf_Ready__2__Extracted\activity.png",
        r"c:\Users\asus\budgetbeam\activity.png"
    ]:
        try:
            with open(path, "wb") as f:
                f.write(response.content)
            print(f"Saved: {path}")
        except Exception as e:
            print(f"Skipped {path}: {e}")
    print("Activity Diagram successfully generated using Kroki!")
else:
    print(f"Error {response.status_code}: {response.text}")
