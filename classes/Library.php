<?php

class Library
{
    # Properties
    //Static Properties
    public static array $books = [];
    public static array $members = [];

    //Properties
    private string $name = "";

    #Methods
    //Constructor
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    //getters
    //get objects of books.
    public function libraryBooks(): array
    {
        return self::$books;
    }
    // get objects of members
    public function libraryMembers(): array
    {
        return self::$members;
    }
    //add methods
    //add a book
    public function addBook(Book $book): void
    {
        if (in_array($book, self::$books)) {
            echo "Book already exist";
            return;
        }
        self::$books[] = $book;
    }
    // add a member
    public function addMember(Member $member): void
    {
        if (in_array($member, self::$members)) {
            echo "Member areldy exist";
            return;
        }
        self::$members[] = $member;
    }
    //find a Book By Title
    public function findBookByTitle(string $title): ?Book
    {
        foreach (self::$books as $book) {
            if (strcasecmp($book->getbookTitle(), $title) === 0) {
                return $book;
            }
        }
        return null;
    }
    //find a Member By Name 
    public function findMemberByName(string $name): ?Member
    {
        foreach (self::$members as $member) {
            if (strcasecmp($member->getmemberName(), $name) === 0) {
                return $member;
            }
        }
        return null;
    }
    // get All the Books in the Library
    public function getAllBooks(): array
    {
        return self::$books;
    }
    // get All the Members in the Library
    public function getAllMembers(): array
    {
        return self::$members;
    }
    #A member borrows a book. update status across book object and member object and Library.
    #error handling, book and member must exist and book available. 
    #display string message based on action. 
    public function borrowBook(string $memberName, string $bookTitle): string
    {
        $member = self::findMemberByName($memberName);
        $book = self::findBookByTitle($bookTitle);

        if ($member === null) {
            return "Member not found.";
        } elseif ($book === null) {
            return "Book not found.";
        } elseif ($book->getStatus() !== BookStatus::Y->value) {
            return "Book is not available.";
        } else {
            $member->borrowBook($book);
            return "Book borrowed successfully.";
            /*
            foreach (self::$members as $libMember) {
                if($libMember === $member){
                $libMember->borrowBook($book);
                return "Book borrowed successfully.";
                }
            }
            */
        }
    }
    public function returnBook(string $memberName, string $bookTitle): string
    {
        $member = self::findMemberByName($memberName);
        $book = self::findBookByTitle($bookTitle);

        if ($member === null) {
            return "Member not found.";
        } elseif ($book === null) {
            return "Book not found.";
        } elseif ($book->getStatus() == BookStatus::Y->value) {
            return "Book cannot be returned, book already in Library";
        } elseif (!in_array($book, $member->getBorrowedBooks())) {
            return "Member does not have this book.";
        } else {
            $member->returnBook($book);
        }
    }
    public function listBooksByStatus(): array {
        $listBooksByStatus = [];
        foreach(self::$books AS $book){

            $listBooksByStatus += [$book->getbookTitle()=>$book->getStatus()];
        }
        return $listBooksByStatus;
    }
}
