<?php

include 'classes/Book.php';
include 'classes/Member.php';

$books = [
    $book1 = new Book("1984", "George Orwell"),
    $book2 = new Book("To Kill a Mockingbird", "Harper Lee"),
    $book3 = new Book("The Great Gatsby", "F. Scott Fitzgerald"),
    $book4 = new Book("Pride and Prejudice", "Jane Austen"),
    $book5 = new Book("The Catcher in the Rye", "J.D. Salinger"),
    $book6 = new Book("The Hunger Games", "Suzanne Collins"),
    $book7 = new Book("The Hobbit", "J.R.R. Tolkien"),
    $book8 = new Book("Fahrenheit 451", "Ray Bradbury"),
];

$members = [
    $member1 = new Member("Alice Johnson"),
    $member2 = new Member("Bob Smith"),
    $member3 = new Member("Carlos Rodriguez"),
    $member4 = new Member("Diana Chen"),
    $member5 = new Member("Emma Thompson"),
    $member6 = new Member("Frank Williams"),
    $member7 = new Member("Grace Lee"),
    $member8 = new Member("Henry Martinez"),
    $member9 = new Member("Isabella Brown"),
    $member10 = new Member("James Anderson")
];

$member2->borrowBook($book5);
$member2->borrowBook($book3);
$member2->borrowBook($book4);

#$member2->returnBook($book5);


echo "<pre>";
print_r($member2->getBorrowedBooks());
echo "<pre>";