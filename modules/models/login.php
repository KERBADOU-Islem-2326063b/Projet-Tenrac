<?php
namespace Blog\Models;

use Database;

class Login {

    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function doLogsExist($usernameLogs, $passwordLogs): bool {
        if (empty($usernameLogs) || empty($passwordLogs)) {
            return false;
        }

        $db = $this->db;
        $query = 'SELECT password FROM user WHERE username = :username';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':username', $usernameLogs);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        if ($result && isset($result['password'])) {
            return password_verify($passwordLogs, $result['password']);
        }

        return false;
    }
}
?>
