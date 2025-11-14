<?php
require_once 'Book.php';

class Member
{
    // static Properties
    private static int $memberIdCounter = 1;

    //properties
    private int $memberID = 0;
    private string $name = "";
    private array $borrowedBooks = [];

    //Constructor
    public function __construct(string $name)
    {
        $this->memberID = self::$memberIdCounter++;
        $this->name = $name;
    }
    //Methods
    #A function for members to borrow a book using an inputfield obkect book. 
    public function borrowBook(Book $book): void
    {
        if ($book->getStatus() !== BookStatus::Y->value) {
            return;
        }

        $this->borrowedBooks[] = $book;
        $book->borrowBook();
    }
    #return the book for members using book object. 
    public function returnBook(Book $book): void
    {
        //Just dounle check if the book is already returned. (user error input)
        if ($book->getStatus() === BookStatus::Y->value) {
            return;
        }

        foreach ($this->borrowedBooks as $key => $value) {
            if ($book->getBookId() === $value->getBookId()) {
                unset($this->borrowedBooks[$key]);
                $this->borrowedBooks = array_values($this->borrowedBooks); //Just reset order. cleancode.
                $book->returnBook();
                break;
            }
        }
    }
    #to fetch member name
    public function getName(): string
    {
        return $this->name;
    }
    #fetch list of books borrowed by this member. Array of books (Book Names) not Objects.
    public function getBorrowedBooks(): array
    {
        $bookNames = [];
        foreach ($this->borrowedBooks as $key => $value) {
            $bookNames[] = $value->getBookName();
        }
        return $bookNames;
    }
    # Information about this user, including the books he is currently holding. 
    public function getInfo(): string
    {
        $bookNames = [];
        if (!empty($this->borrowedBooks)) {
            foreach ($this->borrowedBooks as $key => $value) {
                $bookNames[] = $value->getBookName();
            }
        }
        return $this->memberID . "<br>" . $this->name . "<br>" .  implode("<br>", $bookNames);
    }
}
