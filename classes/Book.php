<?php
require_once 'BookStatus.php';
class Book
{
    //static Properties
    private static int $bookIdCounter = 1;
    
    //properties
    private int $bookId = 0;
    private string $title = "";
    private string $author = "";
    private BookStatus $bookStatus;
    


    //constructor
    public function __construct(string $title, string $author, BookStatus $bookStatus = BookStatus::Y)
    {
        $this->bookId = self::$bookIdCounter++;
        $this->title = $title;
        $this->author = $author;
        $this->bookStatus = $bookStatus;
        Library::addBook($this);
    }

    //set Methods
    #set book status to not available (function can be used by member)
    public function borrowBook()
    {
        $this->bookStatus = BookStatus::N;
    }

    #set book status to available (function can be used by member)
    public function returnBook()
    {
        $this->bookStatus = BookStatus::Y;
    }

    //get Methods
    #get all the info about a book
    public function getBookInfo(): string
    {
        return "Book ID: " . $this->bookId . "<br>" .
            "Title: " . $this->title . "<br>" .
            "Author: " . $this->author . "<br>" .
            "Book Status: " . $this->bookStatus->value . "<br>";
    }
    #get the book ID.
    public function getBookId(): int
    {
        return $this->bookId;
    }
    #Check if the book is available or rented out.
    public function getStatus(): string
    {
        return $this->bookStatus->value;
    }
    #fetch book name. 
    public function getbookTitle(): string
    {
        return $this->title;
    }
    #get the author of the book.
    public function getAuthor(): string
    {
        return $this->author;
    }
}
