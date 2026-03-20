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

\begin{document}

\input{00_CoverPage.tex}
\newpage
\input{01_Certificate_Acknowledgement.tex}
\newpage
\input{02_Abstract.tex}
\newpage
\tableofcontents
\listoftables
\listoffigures
\newpage
\input{04_Introduction.tex}
\input{05_System_Analysis.tex}
\input{06_System_Design.tex}
\input{07_Testing.tex}
\input{08_Deployment_GitHistory.tex}
\input{09_Conclusions_FutureWorks.tex}
\input{10_Appendix.tex}

\end{document}
""",
    "00_CoverPage.tex": r"""\begin{titlepage}
    \centering
    \vspace*{2cm}
    
    \Huge
    \textbf{FSD Project Report}
    
    \vspace{1cm}
    \Large
    \textbf{Budgetbeam: Personal Budget Tracking Platform}
    
    \vspace{2cm}
    \large
    \textbf{Done by:}\\
    {[Student Name]}
    
    \vspace{1cm}
    \textbf{Under the guidance of:}\\
    {[Guide Name]}
    
    \vfill
    
    \vspace{1cm}
    \Large
    [University / Institution Name]
    
\end{titlepage}
""",
    "01_Certificate_Acknowledgement.tex": r"""\chapter*{Certificate}
\addcontentsline{toc}{chapter}{Certificate}
Certified that this is the Bonafide record of project work for \textbf{Budgetbeam: Personal Budget Tracking Platform}.

\vspace{2cm}

\chapter*{Acknowledgement}
\addcontentsline{toc}{chapter}{Acknowledgement}
With heartfelt gratitude, I extend my deepest thanks to...
""",
    "02_Abstract.tex": r"""\begin{abstract}
\addcontentsline{toc}{chapter}{Abstract}
Budgetbeam is a comprehensive personal finance and budget tracking platform developed using the Laravel web framework. Budgetbeam provides users with an engaging environment to manage their personal finances, track daily expenses, and plan monthly budgets effectively.

The platform offers a suite of core features, including an interactive Budget Dashboard for real-time overview of finances, an Expense Tracker for categorized recording, and Analytics to visually display spending habits against set budgets. By combining seamless user interfaces with robust backend tracking, Budgetbeam creates a streamlined and highly effective digital workspace that encourages financial responsibility and continuous personal growth for its users.
\end{abstract}
""",
    "04_Introduction.tex": r"""\chapter{Introduction}
Budgetbeam is an innovative personal finance tracking platform designed to foster better financial management. By blending essential financial utilities such as budget creation, expense categorization, and visual analytics, Budgetbeam transforms the way users interact with their daily spending habits. 

Developed as a responsive web application using the Laravel PHP framework, Budgetbeam ensures a secure, scalable backend architecture. Its frontend is constructed using modern HTML5, CSS3/Tailwind, and vanilla JavaScript for maximum user interactivity.

\chapter{Supporting Literature}
\section{Overview}
Building a modern web application like Budgetbeam requires standing on the shoulders of robust documentation. Key framing documents and architecture guides were analyzed.

\section{Laravel Documentation}
The primary literature driving the backend systems of Budgetbeam is the official Laravel Documentation. This guide dictates the structural MVC routing, Eloquent ORM relationships, and Blade templating used.

\section{Charting \& Analytics Libraries}
To achieve real-time visual analytics for the dashboard, literature regarding JavaScript charting libraries (such as Chart.js) was studied.
""",
    "05_System_Analysis.tex": r"""\chapter{System Analysis}

\section{Module Description}
\begin{itemize}
    \item \textbf{Authentication \& Profile Module:} Secure login, registration, and session management.
    \item \textbf{Budget Management Module:} Creation, editing, and tracking of monthly/weekly budgets.
    \item \textbf{Expense Tracking Module:} Recording individual expenses and linking them to created budgets.
    \item \textbf{Analytics \& Reporting Module:} Visualizing data, remaining balances, and spending trends.
\end{itemize}

\section{Business Rules}
\begin{itemize}
    \item Expenses must belong to an existing category.
    \item Total recorded expenses in a category will deduct from the allocated budget amount.
    \item Users can only view and mutate their own financial data.
\end{itemize}

\section{Use Case Model}

\begin{table}[h!]
\centering
\caption{Use Case Descriptions}
\begin{tabular}{|l|l|p{8cm}|}
\hline
\textbf{ID} & \textbf{Use Case} & \textbf{Description} \\ \hline
UC01 & Register/Login & The user creates an account or authenticates to access the platform. \\ \hline
UC02 & Manage Budgets & The user adds, edits, or removes budget limits for categories. \\ \hline
UC03 & Record Expenses & The user logs new expenses with descriptions and amounts. \\ \hline
UC04 & View Dashboard & The user views analytics, total remaining budgets, and spending charts. \\ \hline
UC05 & Manage Profile & The user updates their profile and settings. \\ \hline
\end{tabular}
\end{table}

\section{Analysis of Architecture}
Budgetbeam is built on Laravel, utilizing an MVC architecture.
\begin{itemize}
    \item \textbf{Model:} Manages PostgreSQL/MySQL data.
    \item \textbf{Controller:} Processes business logic (e.g. subtracting expenses from budgets).
    \item \textbf{View:} Blade templating engine.
\end{itemize}

\section{Feasibility Analysis}
The tech stack (PHP/Laravel) provides strong out-of-the-box features making the project highly technically feasible. Economically, open-source resources eliminate upfront software costs.

\section{System Environment}
\begin{itemize}
    \item \textbf{Backend:} Laravel 11/12 (PHP 8.2+)
    \item \textbf{Frontend:} Blade, HTML5, CSS3, JS.
    \item \textbf{Database:} PostgreSQL/MySQL.
\end{itemize}

\section{Actors and Roles}
\textbf{User:} The sole actor. Manages personal budgets and expenses securely.

""",
    "06_System_Design.tex": r"""\chapter{System Design}

\section{Project Design}

\section{Database Design}

\begin{table}[h!]
\centering
\caption{Users Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key, Auto-increment \\ \hline
name & String & The user's full name \\ \hline
email & String & Unique email address \\ \hline
password & String & Hashed password \\ \hline
created\_at & Timestamp & Record creation date \\ \hline
updated\_at & Timestamp & Record last modification date \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Budgets Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key, Auto-increment \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
name & String & Budget name \\ \hline
amount & Decimal & Allocated budget limit \\ \hline
start\_date & Date & Budget start period \\ \hline
end\_date & Date & Budget end period \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Expenses Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key, Auto-increment \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
category\_id & BigInt & FK referencing Categories \\ \hline
amount & Decimal & Expense amount \\ \hline
description & String & Details of the expense \\ \hline
expense\_date& Date & Date of transaction \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Categories Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key, Auto-increment \\ \hline
name & String & Category name (e.g. Food, Rent) \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Password Reset OTPs Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & BigInt & Primary Key \\ \hline
email & String & Email address \\ \hline
token & String & Reset token \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Sessions Table Schema}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Field Name} & \textbf{Data Type} & \textbf{Description} \\ \hline
id & String & Session ID \\ \hline
user\_id & BigInt & FK referencing Users \\ \hline
payload & Text & Session data \\ \hline
\end{tabular}
\end{table}

\section{UML Diagrams}

\section{Project Pipeline}
""",
    "07_Testing.tex": r"""\chapter{Testing}

\begin{table}[h!]
\centering
\caption{Unit Test Cases}
\begin{tabular}{|l|l|p{6cm}|l|l|}
\hline
\textbf{Test ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected} & \textbf{Status} \\ \hline
UT01 & Authentication & Validates login  & Session generated & Pass \\ \hline
UT02 & Budget Logic & Total minus expenses equals remaining & Accurate calculation & Pass \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Integration Test Cases}
\begin{tabular}{|l|l|p{6cm}|l|l|}
\hline
\textbf{Test ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected} & \textbf{Status} \\ \hline
IT01 & Expense \& Dashboard & Ensure adding an expense updates dashboard charts & Visual data sync & Pass \\ \hline
IT02 & Database Integrity & Ensure deleting a user cascades expenses & Records safely purged & Pass \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{System Test Cases}
\begin{tabular}{|l|l|p{6cm}|l|l|}
\hline
\textbf{Test ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected} & \textbf{Status} \\ \hline
ST01 & Global Navigation & Verify middleware protects dashboard & Guests blocked & Pass \\ \hline
ST02 & Environment & Load standard env configurations & App boots correctly & Pass \\ \hline
\end{tabular}
\end{table}

\begin{table}[h!]
\centering
\caption{Performance Test Cases}
\begin{tabular}{|l|l|p{6cm}|l|l|}
\hline
\textbf{Test ID} & \textbf{Component} & \textbf{Description} & \textbf{Expected} & \textbf{Status} \\ \hline
PT01 & DB Queries & Fetch dashboard analytics & Resolution < 2 sec & Pass \\ \hline
\end{tabular}
\end{table}
""",
    "08_Deployment_GitHistory.tex": r"""\chapter{Deployment}
Folder Structure integrates standard Laravel paradigms (\texttt{app/Http/Controllers}, \texttt{resources/views}, \texttt{routes/web.php}). Packed on Linux/Windows server running PostgreSQL/MySQL.

\chapter{Git History}
Version control ensures reliable tracking of iterative developments (Authentication $\rightarrow$ Budget Engine $\rightarrow$ Analytics UI).
""",
    "09_Conclusions_FutureWorks.tex": r"""\chapter{Conclusions}
Budgetbeam successfully provides an intuitive personal finance management system, integrating essential budget formulation capabilities with insightful visual analytics.

\chapter{Future Works}
\begin{itemize}
    \item \textbf{AI Financial Advice:} Utilizing ML models to analyze spending patterns.
    \item \textbf{Bank Integrations:} Direct API linking for automated transaction recording.
\end{itemize}
""",
    "10_Appendix.tex": r"""\chapter*{Appendix}
\addcontentsline{toc}{chapter}{Appendix}

\begin{itemize}
    \item PHP 8.1+
    \item PostgreSQL/MySQL
    \item Composer
    \item Node.js
\end{itemize}
"""
}

# 1. Delete markdown files
for f in os.listdir(base_dir):
    if f.endswith(".md"):
        os.remove(os.path.join(base_dir, f))

# 2. Write LaTeX files
for filename, content in latex_sections.items():
    file_path = os.path.join(base_dir, filename)
    with open(file_path, "w", encoding="utf-8") as file:
        file.write(content)

print("Latex folder structure converted successfully!")
