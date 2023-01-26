
## About AN Academy Management

 It is a system used to manage the academy, this software is completely built using Laravel Framework. It also supports several languages (Arabic and English). We can explain this arrangement in the Administrator, Teacher, Parent, and Student Dashboard.

#### Admin Dashboard Contains: 

- CRUD grades, classrooms, sections, teachers, and parents.
  >a grade has several classrooms
  >one classroom has several sections.
  >Herever one section has many teachers, In contrast, a teacher belongs to various sections.
  >We use livewire utterly in this tab


- CRUD Students. 
  > The fundamental tab. There is a lot of option we'll talk about it later. At the end of the second term, the students must either get promoted or graduated from that academy if they were in the last classroom of the last stage

- CRUD fees. 
  >We can add study fees for each classroom with a different fee For example, we have two classrooms in Primary Stage, so we can add different charges for each classroom of this stage.

- CRUD Fees Invoices 
  >After registering the student in our school, they will have to pay back his loans whether by installment or lump sum.

- CRUD Student Receipts
  >After the student enrolls, there is a specific period of time during which they can get the loans that they paid off before if they want to leave the academy


----
#### Teacher Dashboard Contains:

- Shows the Sections that he is committed to giving it
- Add quizzes after lectures
- On a daily basis, he can take students' attendance and issue a report
- CRUD Sessions 
  >The teacher can add online classes on the Zoom application.
 For the students so that they attend it.
- After giving the lecture.
  >A teacher uploads lecture files and resources, and students download and read them

----
#### Parents Dashboard Contains:

- View the details of his children
- Filtering the attendance of his children from a specific date to another specific date and presenting it in the form of a report.
- View invoices for children's fees that have been paid before

----
#### Student Dashboard Contains:

- He can enter his tests and then view his grades (failing or passing). Where his father can see these scores.
- He downloads and reads all class files that his teachers upload.
