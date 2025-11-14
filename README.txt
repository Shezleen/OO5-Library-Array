Book.php
Properties:
id (auto-increment)
title
author
status ("IN" or "OUT") → like Gender in Employee
Methods:
__construct(title, author, status="Y")
borrowBook() → set status to "N"
returnBook() → set status to "Y"
getBookInfo()
getBookName()
getStatus()

👤 Member.php
Properties
id (auto-increment)
name
borrowedBooks → array of Book objects
Methods
__construct(string $name)
borrowBook(Book $book)
→ set book status to BookStatus::N
→ add book to $borrowedBooks
returnBook(Book $book)
→ set book status to BookStatus::Y
→ remove book from $borrowedBooks
getName(): string
getBorrowedBooks(): array
getInfo(): string (returns summary text for testing)

✅ Restructured Requirements for Library.php (Based on Your Final Book + Member + Enum)
📌 1. Static Properties
The Library is a global manager. It must hold:
Static arrays:
public static array $books = [];
public static array $members = [];
✅ 📌 2. Required Methods
2.1 addBook(Book $book): void
Purpose: Add a Book object into Library::$books.
Do not add duplicates.
Use the book object directly (not name or id).
2.2 addMember(Member $member): void
Purpose: Add a Member object into Library::$members.
Do not add duplicates.
Use the member object directly.
2.3 findBookByTitle(string $title): ?Book
Purpose: Search Library::$books and return the Book object if the title matches.
Comparison should be case-insensitive.
Return null if not found.
2.4 findMemberByName(string $name): ?Member
Purpose: Search Library::$members and return the Member object.
Case-insensitive comparison.
Return null if not found.
2.5 getAllBooks(): array
Purpose: Return all Book objects stored in the library.
Simple return of self::$books.
2.6 getAllMembers(): array
Purpose: Return all Member objects stored.
Simple return of self::$members.
✅ 📌 3. Borrow / Return Handling (Convenience Methods)
These functions coordinate between Member + Book.
3.1 borrowBook(string $memberName, string $bookTitle): string
Process:
Find the member via findMemberByName().
Find the book via findBookByTitle().
Validate:
Member must exist
Book must exist
Book must be Available
If valid:
Call $member->borrowBook($book)
Return a string message:
"Book borrowed successfully."
"Member not found."
"Book not found."
"Book is not available."
3.2 returnBook(string $memberName, string $bookTitle): string
Process:
Find member.
Find book.
Validate:
Member exists
Book exists
Book must be currently borrowed by this member
If valid:
Call $member->returnBook($book)
Return a string message:
"Book returned successfully."
"Member not found."
"Book not found."
"Member does not have this book."
✅ 📌 4. Optional Feature
4.1 listBooksByStatus(BookStatus $status): array
Return an array of Book objects that match:
BookStatus::Y (Available)
BookStatus::N (Not Available)

🖥️ index.php (Main Script)
Responsibilities
Include all class files.
Initialize library data (sample books and members).
Test functionality:
Add new books and members
Borrow books
Return books
Search and list data

🧩 2️⃣ Functional Requirements
#	Task	Description
1	Add new Book	Create new Book objects and add to Library::$books
2	Add new Member	Create new Member objects and add to Library::$members
3	Borrow a Book	Update book status to BookStatus::N and attach to member
4	Return a Book	Update book status to BookStatus::Y and remove from member
5	Search Book	Find by title
6	Search Member	Find by name
7	List all Books	Show all book info
8	List all Members	Show all member info
9	List Books by Status	Show only “Available” or “Not Available” books

⚙️ 3️⃣ Non-Functional Requirements
No database or files — use arrays.
Use static properties for global object management.
Maintain relationships between Member and Book (bidirectional effect).
Each file: one class, one responsibility.