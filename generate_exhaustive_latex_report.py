import os

base_dir = r"c:\Users\asus\budgetbeam\Budgetbeam_FSD_Report"
os.makedirs(base_dir, exist_ok=True)

latex_sections = {
    "main.tex": r"""\documentclass[12pt,a4paper]{report}
\usepackage[utf8]{inputenc}
\usepackage{graphicx}
\usepackage{hyperref}
\usepackage{geometry}
\geometry{a4paper, margin=1in}
\usepackage{longtable}
\usepackage{array}
\usepackage{fancyhdr}
\usepackage{listings}
\usepackage{color}

\pagestyle{fancy}
\fancyhf{}
\rhead{Budgetbeam: FSD Report}
\lhead{\leftmark}
\rfoot{Page \thepage}

\hypersetup{
    colorlinks=true,
    linkcolor=blue,
    filecolor=magenta,      
    urlcolor=cyan,
}

\begin{document}

\input{01_Front_Matter.tex}

\pagenumbering{roman}
\tableofcontents
\listoftables
\listoffigures
\newpage

\pagenumbering{arabic}
\input{02_Intro_Literature.tex}
\input{03_System_Analysis.tex}
\input{04_System_Design.tex}
\input{05_Testing.tex}
\input{06_Deployment_Git_Conclusion.tex}
\input{07_Appendix.tex}

\end{document}
""",
    "01_Front_Matter.tex": r"""\begin{titlepage}
    \centering
    \vspace*{2cm}
    \includegraphics[width=0.3\textwidth]{logo.png}\\[1cm] % Placeholder for logo
    \Huge
    \textbf{FSD Project Report}
    \vspace{1.5cm}
    
    \Huge
    \textbf{Budgetbeam: Personal Budget Tracking Platform}
    
    \vspace{2.5cm}
    \large
    \textbf{Done by:}\\
    Aneeta Peter\\
    Reg No: 24118006
    
    \vspace{1.5cm}
    \textbf{Under the guidance of:}\\
    Mr. Ajay Antony Joseph
    
    \vfill
    \Large
    Department of Computer Science\\
    Rajagiri College of Social Sciences (Autonomous)\\
    2024-2028
\end{titlepage}

\chapter*{Certificate}
\addcontentsline{toc}{chapter}{Certificate}
\begin{center}
\textbf{Budgetbeam: Personal Budget Tracking Platform}
\end{center}
Certified that this is the Bonafide record of project work done by \textbf{Aneeta Peter}, Reg No: \textbf{24118006}, during the academic year 2024-2028, in partial fulfillment of requirements for award of the degree, Bachelor of Science in Computer Science of Rajagiri College of Social Sciences (Autonomous).

\vspace{3cm}
\noindent Faculty Guide \hfill Head of the Department\\
Mr. Ajay Antony Joseph \hfill Dr. Bindiya M Varghese

\chapter*{Acknowledgement}
\addcontentsline{toc}{chapter}{Acknowledgement}
With heartfelt gratitude, I extend my deepest thanks to the Almighty for His unwavering grace and blessings. I am immensely thankful to Dr. Bindiya M Varghese, Head of the Department of Computer Science, and Mr. Ajay Antony Joseph, my Faculty Guide, for their invaluable guidance and timely advice. Their constant supervision and provision of essential information were instrumental in the successful completion of the Project. I also extend my profound thanks to all the professors in the department and the entire staff at RCSS for their support. Finally, I am grateful to my family and friends for their encouragement and assistance throughout this endeavor.

\chapter*{Abstract}
\addcontentsline{toc}{chapter}{Abstract}
Budgetbeam is a sophisticated personal finance and budget tracking platform engineered to empower users with precise control over their financial behavior. Developed using the Laravel 12.x web framework and PHP 8.2, Budgetbeam provides a streamlined environment to manage incomes, track daily expenses, and establish detailed monthly budgets.

The platform integrates several high-impact modules, including a Dynamic Dashboard for real-time overview of financial health, an Automated Expense Categorization system, and a Financial Milestone tracker that incentivizes saving through visual rewards. By leveraging the security of PostgreSQL for ACID-compliant transactions and the interactivity of Chart.js for data visualization, Budgetbeam ensures a professional and reliable experience. The system is designed to redefine modern personal task management and financial literacy for students and professionals alike, creating a rewarding digital workspace for long-term fiscal discipline.
""",
    "02_Intro_Literature.tex": r"""\chapter{Introduction}
In an era of increasing economic complexity, the ability to manage personal finances effectively is a critical skill. Budgetbeam is an innovative personal budget tracking platform designed to simplify the recording of financial transactions and the planning of future savings. By combining traditional bookkeeping with modern web technologies, Budgetbeam transforms the often-tedious task of expense tracking into an engaging and intuitive experience.

Developed as a highly responsive web application using the Laravel framework, Budgetbeam ensures a secure, scalable, and secure architecture. Its frontend is constructed using Tailwind CSS and vanilla JavaScript to provide maximum user interactivity. From integrated dashboards that visualize category-wise spending to automated reminders for budget limits, Budgetbeam provides a comprehensive suite of utilities to manage personal wealth.

\chapter{Supporting Literature}
\section{Overview}
Building a modern financial platform like Budgetbeam requires standing on the shoulders of robust, open-source literature and documentation. Several key architecture guides and technical specifications were analyzed.

\section{Laravel Documentation}
The primary literature driving the backend systems is the official Laravel 12.x Documentation. This comprehensive guide dictates the structural MVC routing, Eloquent ORM relationships, and Blade templating methodologies used to render the professional dashboard and reporting interfaces.

\section{PostgreSQL Technical Specifications}
Reliable financial tracking necessitates a robust relational database. The PostgreSQL documentation provided the foundational methodology for designing ACID-compliant transactions, ensuring that every expense recording and budget adjustment is processed with absolute data integrity.

\section{Data Visualization Paradigms}
To implement the interactive charts used in the Analytics module, literature regarding JavaScript charting libraries—specifically Chart.js—was studied. This provided the methodology for translating flat database records into dynamic, visual representations of spending trends.
""",
    "03_System_Analysis.tex": r"""\chapter{System Analysis}
\section{Module Description}
The Budgetbeam platform is strategically divided into functional modules:
\begin{itemize}
    \item \textbf{Authentication \& Profile Module:} Manages secure user identities, session persistence, and personal preferences using Laravel's robust authentication middleware.
    \item \textbf{Budget Management Module:} Serves as the navigational hub for the user, allowing for the definition of time-bound financial limits across various categories such as Rent, Groceries, and Education.
    \item \textbf{Expense Tracking Module:} The core transactional engine of the application, enabling the seamless logging of daily expenditures with automatic association to budgets and categories.
    \item \textbf{Analytics \& Reporting Module:} Leverages Chart.js to provide users with a visual breakdown of their spending habits, remaining balances, and savings metrics in real-time.
\end{itemize}

\section{Business Rules}
\begin{itemize}
    \item \textbf{Transaction Integrity:} Every expense must be associated with a valid user\_id and a category\_id.
    \item \textbf{Budget Constraints:} Users are alerted visually when their expenditure for a specific category exceeds $90\%$ of its allocated budget.
    \item \textbf{Privacy Protocols:} No user can view or modify the financial records of another user; all queries are strictly scoped to the authenticated session.
    \item \textbf{Categorization:} Expenses logged without a specific category are automatically funneled into a 'General' catch-all category to prevent data loss.
\end{itemize}

\section{Use Case Model}
\subsection{Use Case Descriptions}
\begin{longtable}{|l|l|p{8cm}|}
\caption{Use Case Descriptions for Budgetbeam} \\
\hline
\textbf{ID} & \textbf{Use Case} & \textbf{Description} \\ \hline
UC01 & Register / Login & The user creates a new account or authenticates with existing credentials. \\ \hline
UC02 & Manage Budgets & The user adds, edits, or removes financial limits for specific categories. \\ \hline
UC03 & Record Expense & The user logs a new expenditure with details on amount, date, and category. \\ \hline
UC04 & View Analytics & The user views charts and summaries of their total spending vs budget. \\ \hline
UC05 & Export Report & The user generates a PDF/CSV summary of their monthly financial activity. \\ \hline
UC06 & Manage Categories & The user creates custom categories for more granular tracking. \\ \hline
\end{longtable}

\subsection{Use Case Diagram}
\begin{figure}[h!]
    \centering
    \caption{Use Case Diagram for Budgetbeam}
    \textbf{[Insert Use Case Diagram Graphic Here]}
\end{figure}

\section{Feasibility Analysis}
\subsection{Technical Feasibility}
The tech stack for Budgetbeam is highly feasible. PHP 8.2 with Laravel provides built-in authentication, ORM, and routing which simplifies development. PostgreSQL ensures high-performance relational storage.
\subsection{Economical Feasibility}
The project relies on open-source technologies, eliminating licensing costs. Hosting a Laravel application on standard cloud infrastructures is cost-effective and scalable.
\subsection{Operational Feasibility}
The intuitive UI and automated tracking features reduce cognitive load for users, making the task of personal budgeting friction-free and sustainable for long-term use.

\section{Actors and Roles}
\textbf{User (Primary Actor):} The sole actor within Budgetbeam. They own their data, manage their budgets, and analyze their own financial reports.

\section{Activity Diagram}
\begin{figure}[h!]
    \centering
    \caption{Activity Diagram for Budgetbeam platform}
    \textbf{[Insert Activity Diagram Graphic Here]}
\end{figure}
""",
    "04_System_Design.tex": r"""\chapter{System Design}
\section{User Interface (UI) Design}
Budgetbeam's UI is built for modern accessibility and financial clarity.
\begin{itemize}
    \item \textbf{Dashboard UI:} A centralized view presenting the current month's total budget, actual spending, and most active categories.
    \item \textbf{Budget Entry UI:} A modal-driven interface for defining category allocations with real-time validation.
    \item \textbf{Expense Log UI:} A searchable, paginated table of all historical expenditures.
\end{itemize}

\section{System Architecture Diagram}
\begin{figure}[h!]
    \centering
    \caption{Budgetbeam System Architecture}
    \textbf{[Insert System Architecture Diagram Here]}
\end{figure}

\section{Database Design}
The relational schema consists of 8 tables across three functional categories: Core, Category, and Framework.

\subsection{Core Financial Tables}
\begin{longtable}{|l|l|l|}
\caption{Users Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key, Auto-increment \\ \hline
name & String & The user's full name \\ \hline
email & String & Unique email address for authentication \\ \hline
password & String & Hashed password \\ \hline
created\_at & Timestamp & Account creation date \\ \hline
\end{longtable}

\begin{longtable}{|l|l|l|}
\caption{Budgets Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
category\_id & BigInt & FK referencing Categories \\ \hline
amount & Decimal(10,2) & Allocated budget amount \\ \hline
start\_date & Date & Budget period start \\ \hline
end\_date & Date & Budget period end \\ \hline
\end{longtable}

\begin{longtable}{|l|l|l|}
\caption{Expenses Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
category\_id & BigInt & FK referencing Categories \\ \hline
budget\_id & BigInt & FK referencing Budgets (nullable) \\ \hline
amount & Decimal(10,2) & Expenditure amount \\ \hline
description & String & Details of the expense \\ \hline
date & Date & Date of transaction \\ \hline
\end{longtable}

\subsection{Category \& Utility Tables}
\begin{longtable}{|l|l|l|}
\caption{Categories Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key \\ \hline
user\_id & BigInt & FK referencing Users (nullable for system defaults) \\ \hline
name & String & Category label (e.g., Food, Rent) \\ \hline
color & String & UI color for charts (Hex code) \\ \hline
\end{longtable}

\begin{longtable}{|l|l|l|}
\caption{Notifications Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & UUID & Primary Key \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
data & JSON & Notification payload (e.g., "Budget Exceeded") \\ \hline
read\_at & Timestamp & Timestamp when viewed \\ \hline
\end{longtable}

\subsection{Laravel Framework Tables}
\begin{longtable}{|l|l|l|}
\caption{Sessions Table Schema} \\
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & String & Primary Key \\ \hline
user\_id & BigInt & FK to Users (nullable) \\ \hline
payload & Text & Serialized session data \\ \hline
last\_activity & Integer & Unix timestamp \\ \hline
\end{longtable}

\section{UML Documentation}
\subsection{Class Diagram}
\textbf{[Insert Class Diagram Placeholder]}
\subsection{Entity-Relationship (ER) Diagram}
\textbf{[Insert ER Diagram Placeholder]}
\subsection{Sequence Diagram (Expense Logging)}
\textbf{[Insert Sequence Diagram Placeholder]}

\section{Project Development Pipeline}
\textbf{[Insert Pipeline Diagram Placeholder]}
""",
    "05_Testing.tex": r"""\chapter{Testing}
Testing is a crucial part of the Budgetbeam development lifecycle, ensuring accuracy in financial calculations and security in data handling.

\section{Unit Testing}
\begin{longtable}{|l|l|p{5.5cm}|p{3.5cm}|l|}
\caption{Unit Test Cases for Budgetbeam} \\
\hline
\textbf{ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected Result} & \textbf{Status} \\ \hline
UT01 & Auth Login & Validates user credentials on login & Session established & Pass \\ \hline
UT02 & Budget Calc & Check if remaining balance subtracts expenses correctly & Correct Decimal & Pass \\ \hline
UT03 & Category & Validates that categories cannot have empty names & Validation Error & Pass \\ \hline
UT04 & Precision & Verifies that amounts are handled with 2 decimal places & No rounding errors & Pass \\ \hline
UT05 & Dashboard & Check if zero-data states render 'No data' charts & UI renders correctly & Pass \\ \hline
\end{longtable}

\section{Integration Testing}
\begin{longtable}{|l|l|p{5.5cm}|p{3.5cm}|l|}
\caption{Integration Test Cases} \\
\hline
\textbf{ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected Result} & \textbf{Status} \\ \hline
IT01 & UI-DB Entry & Record expense via form and check DB entry & Row created correctly & Pass \\ \hline
IT02 & Auth Guard & Attempt to delete budget without authentication & 403 Forbidden & Pass \\ \hline
IT03 & Chart Sync & Add expense and verify Chart.js dataset updates & Visual chart change & Pass \\ \hline
IT04 & Cascade Delete & Delete category and check associated expense status & Handled gracefully & Pass \\ \hline
\end{longtable}

\section{System Testing}
\begin{longtable}{|l|l|p{4cm}|l|}
\caption{System Test Cases} \\
\hline
\textbf{ID} & \textbf{Component} & \textbf{Description} & \textbf{Status} \\ \hline
ST01 & Full Launch & App serves landing page routes & Pass \\ \hline
ST02 & Auth Gate & Protected routes inaccessible to guests & Pass \\ \hline
ST03 & Module Sync & Dashboard, Budgets, and Expenses modules share data & Pass \\ \hline
ST04 & UI Theming & Validation of Tailwind CSS builds across views & Pass \\ \hline
\end{longtable}

\section{Performance Testing}
\begin{longtable}{|l|l|p{6cm}|l|}
\caption{Performance Test Cases} \\
\hline
\textbf{ID} & \textbf{Component} & \textbf{Description} & \textbf{Status} \\ \hline
PT01 & DB Latency & Large scale query for yearly expenditure summary & Pass \\ \hline
PT02 & Concurrent & Multiple users accessing the dashboard simultaneously & Pass \\ \hline
PT03 & Asset Load & Time to render the dashboard with Chart.js assets & Pass \\ \hline
\end{longtable}
""",
    "06_Deployment_Git_Conclusion.tex": r"""\chapter{Deployment}
\section{Folder Structure}
Budgetbeam strictly follows Laravel's directory scaffolding to ensure clean separation of concerns.
\begin{itemize}
    \item \texttt{app/Http/Controllers}: Houses business logic for core financial operations.
    \item \texttt{resources/views}: Contains the Blade templating files for the frontend UI.
    \item \texttt{routes/web.php}: Defines the entry points for all web-based requests.
    \item \texttt{public/assets}: Stores compiled Tailwind CSS and Chart.js libraries.
\end{itemize}

\chapter{Git History}
Version control was managed via Git to track the iterative development of the budget tracker. This allowed for seamless collaboration and the ability to revert changes during the integration of complex modules like the real-time Analytics engine.

\chapter{Conclusions}
Budgetbeam has successfully achieved its objective of providing a centralized and secure platform for personal financial management. By integrating essential tools such as budget planning with engaging visual analytics, the platform helps users overcome the psychological hurdles of consistent financial tracking. The robust Laravel-based architecture ensures that the application is both secure and scalable, offering a professional companion for modern users who want to take full control of their economic future.

\chapter{Future Works}
\begin{itemize}
    \item \textbf{AI Expense Prediction:} Implementing machine learning models to forecast future spending based on historical data patterns.
    \item \textbf{Direct Bank Sync:} Integrating with banking APIs to automatically fetch and categorize transactions.
    \item \textbf{Investment Tracker:} Expanding the platform to include stocks, crypto, and traditional asset tracking modules.
\end{itemize}
""",
    "07_Appendix.tex": r"""\chapter*{Appendix}
\addcontentsline{toc}{chapter}{Appendix}

\section*{Minimum Software Requirements}
\begin{itemize}
    \item \textbf{OS:} Windows 10/11, macOS, or modern Linux.
    \item \textbf{PHP:} Version 8.2 or higher.
    \item \textbf{Database:} PostgreSQL 14 or higher.
    \item \textbf{Web Server:} Apache or Nginx.
    \item \textbf{Dependency Manager:} Composer 2.x.
\end{itemize}

\section*{Minimum Hardware Requirements}
\begin{itemize}
    \item \textbf{Processor:} Modern multi-core CPU (Intel i3 / Ryzen 3 or better).
    \item \textbf{RAM:} 4 GB (8 GB recommended for development).
    \item \textbf{Storage:} 10 GB free space for database, logs, and application files.
\end{itemize}
"""
}

for filename, content in latex_sections.items():
    file_path = os.path.join(base_dir, filename)
    with open(file_path, "w", encoding="utf-8") as file:
        file.write(content)

print("Exhaustive LaTeX FSD Report documents generated successfully in Budgetbeam_FSD_Report!")
