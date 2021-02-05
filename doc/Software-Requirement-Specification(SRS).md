# **Table of Content:**
- [Introduction](#introduction)
  - [Purpose](#purpose)
  - [Scope](#scope)
- [Definition, Acronyms and Abbreviations](#definition-Acronyms-and-Abbreviations)
- [References](#references)
- [Project name](#project-name)
- [Team](#team)
- [Overall Description](#overall-Description)
  - [Problem Statement](#problem-Statement)
  - [Background](#background)
  - [Objectives](#objectives)
- [Functional Requirements](#functional-Requirements)
  - [Registration](#registration)
  - [Account](#account)
  - [Navigation](#navigation)
  - [Features](#features)
  - [Admin](#admin)
- [Requirements](#requirements)
  - [User and Lawyers Requirements](#user-and-lawyer-requirements)
  - [Admin Requirements](#admin-Requirements)
- [Technical Requirements](#technical-Requirements)
  - [Security](#security)
  - [Maintainability](#maintainability)
  - [Usability](#usability)
  - [Localization Support](#localization-Support)
  - [Availability](#availability)
- [System Requirements](#system-Requirements)
- [Deployment Requirements](#deployment-Requirements)




# **Introduction**
## **Purpose**
1. This document is to present a detailed description of the Web System for online law consulting project. It will explain the purpose and features of the system, the interfaces of the system, what the system will do, the constraints under which it must operate and how the system will react to external stimuli. This document is intended for both the stakeholders and the developers of the system.
2. The purpose of the OLA is to create an online platform that helps citizens easily get legal consulting from qualified lawyers, and as for lawyers they will be able to find new clients and interact effectively with them. This will make the cooperation between both sides as comfortable and simple as possible, which will allow to improve quality of the legal services in Kyrgyzstan.
## **Scope**
The OLA is designed to facilitate Web based System for getting online consulting.The present SRS is an attempt in this direction so as facilitate as subsequent  development and development and implementation of the system.
The Software will have functional modules for most of the activities like (basics are)sign up, sign in, like, search, ask and answer to questions, etc.A Back-End database working for maintaining users and lawyers records by admin.
The proposed system will provide user-friendly interface, so everyone can use it.
This System will be useful firstly for citizens who does not have enough time to come to lawyers in real and for lawyers who wants to find many new clients as fast as possible.

***

# **Definition, Acronyms and Abbreviations**
| Term    | Definition      | 
|---------|-----------|
| OLA     | Online Law Consultant      |  
| App     | Application    |  
| SRS     | <p>Software Requirement Specification</p>      |  
| KR     | <p>Kyrgyz Republic</p>      |  
| Use Case     | <p>list of actions or event steps typically defining the interactions between a role (known in the Unified Modeling Language (UML) as an actor) and a system to achieve a goal</p>      | 
| User Story     | <p>an informal, natural language description of one or more features of a software system.</p>      | 
| Web     | <p>an Internet-based hypertext system.</p>      | 


***
# **References**
* [Link to EasyBackLog(To UserStories)](https://easybacklog.com/accounts/28023/backlogs/309511)
* [UML Diagrams were created here.](https://online.visual-paradigm.com)

***

# **Project name**
 **Online Law Consultant**
# **Team** 
1.  **Gulzat Umetalieva** 
* role: Scrum Master, Front-End Developer
* email: _gulzat.umetalieva@iaau.edu.kg_
2. **Eridan Sarygulov**
* role: Back-End Developer
* email: _eridan.sarygulov@iaau.edu.kg_
3. **Kalzira Sabytakunova**
* role: Requirement Engineer
* email: _kalzira.sabytakunova@iaau.edu.kg_
4. **Nuriddin Kadyrov**
* role: Front-End Developer
* email: _nuriddin.kadyrov@iaau.edu.kg_
5. **Akzholtoi Kanimetova**
* role: Front-End Developer
* email:_akzholtoi.kanimetova@iaau.edu.kg_
6. **Zhamiila Kartanbaeva**
* role: Tester
* email: _zhamiila.kartanbaeva@iaau.edu.kg_
7. **Alina Zhakypova**
* role: Tester
* email: _alina.zakypova@iaau.edu.kg_
8. **Abdygany Isaev** 
* role: Back-End Developer
* email:_abdygany.isaev@iaau.edu.kg_
9.  **Ababakri Ibragimov** 
* role: Back-End Developer
* email:_ababakri.ibragimov@iaau.edu.kg_


***
# **Overall Description**

## **Problem Statement**
 Often only few citizens understand the law, their rights and sometimes even amendments to the laws contradict each other or have different interpretations. Therefore, amateurs can make many mistakes that can affect their business for example. So they need providing of  legal advice by thoroughly investigating their matters. They faced with the problems when they don't ensure if they are in right standing with the law. Therefore,  Help of lawyer will save from unnecessary problems in disputes related to real estate, inheritance, contract development and much more. Anyway, there are a number of factors that disturb free and comfortable communication between lawyers and citizens:
Not all people have enough time to search and visit a lawyer advisor.
Many are not aware of this area and do not risk.
There are those who want to save money by underestimating the work of a lawyer and overestimating their capabilities.
Quick and easy access to law services and information about them could significantly increase the number of people who want to get advice, and therefore the number of people who have successfully resolved legal issues.
## **Background**
Nowadays, the development of new technologies is fast. In our country, the penetration of the Internet (especially mobile) is increasing every day. More and more people prefer watching movies or TV shows on the Internet instead of tv, and instead of sending mail they prefer  messengers. Design of an online system is relevant  in many industries . And the legal industry is no exception. If it would be online, more customers will appear, time and money, human and technical resources will be saved and etc. The legal industry will be able to move to a new level in KR. Having the existing problem representing by need of citizens to get qualified legal assistance as well as a large number of unemployed lawyers, the creation of this system is beneficial for both sides.

## **Objectives**
* _For citizens:_
 **Getting an answer.** To develop such system where users of this system can find or ask questions that they want to get answer for it.

* _For lawyers:_
 **Answer to questions.** To develop such system which will allow to answer for questions that lawyers want to help for citizens and improve professional skills, communicate with colleagues and by increasing personal popularity - find new customers.

* _For all:_
 **User-friendliness.** To develop such system that will be convenient for all users of this system.
Getting information. To develop such system that will  contain useful information about the state of the legal sphere in the country (news for example) for all users.

***

# **Functional Requirements**
### **Use Cases**

### 1.**Registration**
![SignUpUC](https://user-images.githubusercontent.com/43117184/55685709-4087c580-597b-11e9-962d-4609d7e5f2ae.jpg)

![signInUC](https://user-images.githubusercontent.com/43117184/55685342-c1908e00-5976-11e9-8e8e-789692731fb3.jpg)

![LogOutUC](https://user-images.githubusercontent.com/43117184/55685930-42528880-597d-11e9-8224-b4211fc927aa.jpg)
### 2.**Account**
![resetUC](https://user-images.githubusercontent.com/43117184/55685388-61e6b280-5977-11e9-806a-350d6c12ad4c.jpg)
![deleteaccUC](https://user-images.githubusercontent.com/43117184/55685722-5eedc100-597b-11e9-9cf0-fc01e82b1658.jpg)
![avatarUC](https://user-images.githubusercontent.com/43117184/55685727-62814800-597b-11e9-834f-9e0c8c14577d.jpg)

### 3.**Navigation**

![NavigationUC](https://user-images.githubusercontent.com/43117184/55686190-e50c0680-597f-11e9-91a8-32fbc56ef506.jpg)

### 4.**Features**
![askviewsearchquesrions](https://user-images.githubusercontent.com/43117184/55685757-b2f8a580-597b-11e9-8bdc-2384272621a1.jpg)
![likeUC](https://user-images.githubusercontent.com/43117184/55685773-d15ea100-597b-11e9-90f6-219fe2a4d4a3.jpg)
![chooselawUC](https://user-images.githubusercontent.com/43117184/55685764-c441b200-597b-11e9-98f7-1570f5398f5e.jpg)


### 5.**Admin**
![adminUC](https://user-images.githubusercontent.com/43117184/55685955-8776ba80-597d-11e9-8bf5-b9c9dd7bdb7a.jpg)

![AdminUCDescription](https://user-images.githubusercontent.com/43117184/55686226-58157d00-5980-11e9-9d50-77f1cabb4854.jpg)

***


# **Requirements**

![RequirementsDescription](https://user-images.githubusercontent.com/43117184/55686260-bb071400-5980-11e9-9525-6ccc1f7317ea.jpg)

### **User And Lawyer Requirements**
| User Requirements    | 
|---------|
| Users should be able to use the system from any Web browser supporting HTML 3.2 (or later).
User should be able to use the system from any device and be comfortable on each.
Visitors new to the site should be able to register by themselves. Users will be differentiated by unique user identifiers.
User should be able to easily find questions page with answers
Site visitors should be able to view questions and answers without registration
Users should be able to view a complete list of categories of questions.
Users and guests should be able to search for questions by related attributes. 
Users should be able to ask question.
Users should be able to see all available information about existing lawyers.
Users and guests should be able to see news page.
All existing answers to questions should be available for users and guests.
Users should be able to view the status of question.
Users and guests should be able to switch between languages.
Large numbers of users should be able to use the application simultaneously.
The performance of the application should not degrade with an increase in the number of goods or services offered.
User should be able to leave review about the site work.  | 


| Lawyer Requirements    | 
|---------|
| Lawyers should be able to use the system from any Web browser supporting HTML 3.2 (or later).
Lawyers should be able to use the system from any device and be comfortable on each.
Lawyers new to the site should be able to register by themselves. Lawyers will be differentiated by unique user identifiers.
Lawyers should be able to collect likes to improve their profiles.
Lawyers should be able to easily find unanswered questions.
Lawyers should be able to view news page.
Lawyers should be able to add all needable information about them and their company.
Lawyers should be able to view a complete list of categories of questions.
Lawyers should be able to search for questions by related attributes. 
Lawyers should be able to answer to question.
Lawyers  should be able to see news page.
Lawyers should be able to view the status of question.
Lawyers should be able to use convenient language for them.
Large numbers of lawyers should be able to use the application simultaneously.
The performance of the application should not degrade with an increase in the number of goods or services offered.
Lawyers should be able to leave review about the site work.| 


### **Admin Requirements**

| Admin Requirements    | 
|---------|
| Administrators should be able to manage OLA system using Web browsers.
Data managers should be able to delete users.
Site administrators should be able to change the status of questions  by users after they have been answered.
Administrator should be able to control all users.   |


***

# **Technical Requirements**

### **Security**
Provide different kinds of the  requirements to users and lawyers of the system such as require the use of password or confirmed email after resetting password. Lawyers should be verified by admin.
### **Maintainability**
Maintenance is one form of change that typically done after development has been completed.As the times changes, so do the needs. This system requires updation of information of the database by the admin. Any other feature as per the requirement can be added later at any time.
### **Usability**
Each user or lawyer can have personal account and customize it, use search box, have responsible web system, so that will be convenient on any device.
### **Localization Support**
The system allows to users and lawyers to switch between languages.<br>

Three available languages:

* Russian
* English
* Kyrgyz

### **Availability**
The application will run 24 X 7 if internet connection is available.


***

# **System Requirements**
The system will be able to be viewed in all types of modern website browsers such as, Chrome, Firefox, Mozilla & Safari.


***
# **Deployment Requirements**
Users does not need To install any tools to run the system since OLA is web based.



[Go Up](#table-of-Content)
