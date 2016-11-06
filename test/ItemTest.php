<?php

require_once __DIR__ . '/../vendor/autoload.php';

class UserTest extends PHPUnit_Extensions_Database_TestCase {

    protected static $connection;

    public function getConnection() {
        $conn = new PDO (
            $GLOBALS['DB_DSN'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWD']
        );

        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXMLDataSet(__DIR__ . '/../dataset/Items.xml');
    }

    public static function setUpBeforeClass() {
        self::$connection = new mysqli(
            $GLOBALS['DB_HOST'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWD'],
            $GLOBALS['DB_NAME']);

        if (self::$connection->connect_error) {
            die(self::$connection->connect_error);
        }
    }


    public static function tearDownAfterClass() {
        self::$connection->close();
        self::$connection = null;
    }

    public function testIfLoginReturnsIdWithCorrectParams() {

        $this->assertEquals(1, User::login(self::$connection, 'damian.grabowski@gmail.com', 'df4ghe4et4'));

    }

    public function testIfGetUserByEmailReturnsCorrectUser() {
        $user = new User(2, 'anna@gmail.com');
        $user->setPassword('$2y$10$ibaGQBpZNUqNpzpij4PtUuKzitOZvhygdSDE6HSB1QSHXKK2KhTmm', false);
        $userFromDB = User::getUserByEmail(self::$connection, 'anna@gmail.com');

        $this->assertEquals($user, $userFromDB);
    }

}