<?php

/**
 * Create | Register? Поведение пользователя в рамках Доктриы - Создать? А не Регистрация? 
 * ДТО Регистрации - это слой между контроллером\реквест и некой моделью с валидацией 
 * Create - поведение, которое униварсальное, не просто Регистер (через емейл), а еще и через
 * прочие методы можно создать (oauth и т.д.)
 * 
 * На фронте валидировать форму и писать все ошибки "Укоротите Имя до 16 букв".
 * На back перегонять request в DTO с некоторой чисткой.
 * Например, EmailVO email, integer id. Использовать встроенные типы или сделать ValueObjects.
 * Если из реквеста что-то плохое попало, то error и всё.
 * Единственное, не ясно, где финальная проверка.. в ДТО логику нельзя. В контроллере, наверное.
 */


final readonly class UserCreateDTO
{
    public function __construct(
         
        public string $passHash,
        public string $email, 
        
    ) {
    }
}

/*
final readonly class UserCreateDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email, //Email - VO
        public DateTimeImmutable $createdAt,
    ) {
    }
}
*/
