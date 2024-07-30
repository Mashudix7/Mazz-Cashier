<?php

function getAllUsers() {
    $users = [];
    $file_path = 'data/users.txt';

    if (file_exists($file_path)) {
        $file = fopen($file_path, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (!empty($line)) {
                    $parts = explode('|', $line);
                    if (count($parts) === 3) {
                        list($username, $password, $role) = $parts;
                        $users[] = [
                            'username' => htmlspecialchars(trim($username)),
                            'password' => htmlspecialchars(trim($password)),
                            'role' => htmlspecialchars(trim($role))
                        ];
                    }
                }
            }
            fclose($file);
        } else {
            error_log("Failed to open file $file_path.");
        }
    } else {
        error_log("File $file_path does not exist.");
    }
    return $users;
}

function getAllProducts() {
    $products = [];
    $file_path = 'data/products.txt';

    if (file_exists($file_path)) {
        $file = fopen($file_path, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (!empty($line)) {
                    $parts = explode('|', $line);
                    if (count($parts) === 2) {
                        list($product_name, $price) = $parts;
                        $products[] = [
                            'product_name' => htmlspecialchars(trim($product_name)),
                            'price' => filter_var(trim($price), FILTER_VALIDATE_FLOAT)
                        ];
                    }
                }
            }
            fclose($file);
        } else {
            error_log("Failed to open file $file_path.");
        }
    } else {
        error_log("File $file_path does not exist.");
    }
    return $products;
}

function getAllTransactions() {
    $transactions = [];
    $file_path = 'data/transactions.txt';

    if (file_exists($file_path)) {
        $file = fopen($file_path, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (!empty($line)) {
                    $parts = explode('|', $line);
                    if (count($parts) === 4) {
                        list($product_name, $quantity, $price, $date) = $parts;
                        $transactions[] = [
                            'product_name' => htmlspecialchars(trim($product_name)),
                            'quantity' => filter_var(trim($quantity), FILTER_VALIDATE_INT),
                            'price' => filter_var(trim($price), FILTER_VALIDATE_FLOAT),
                            'date' => htmlspecialchars(trim($date))
                        ];
                    }
                }
            }
            fclose($file);
        } else {
            error_log("Failed to open file $file_path.");
        }
    } else {
        error_log("File $file_path does not exist.");
    }
    return $transactions;
}

function saveSupportRequest($username, $issue) {
    $username = htmlspecialchars(trim($username));
    $issue = htmlspecialchars(trim($issue));
    $file_path = 'data/support_requests.txt';

    $file = fopen($file_path, 'a');
    if ($file) {
        $result = fwrite($file, "$username|$issue\n");
        fclose($file);
        return $result !== false;
    } else {
        error_log("Failed to open file $file_path for appending.");
        return false;
    }
}

function addUser($username, $password, $role) {
    $username = htmlspecialchars(trim($username));
    $password = htmlspecialchars(trim($password));
    $role = htmlspecialchars(trim($role));
    $file_path = 'data/users.txt';

    $file = fopen($file_path, 'a');
    if ($file) {
        $result = fwrite($file, "$username|$password|$role\n");
        fclose($file);
        return $result !== false;
    } else {
        error_log("Failed to open file $file_path for appending.");
        return false;
    }
}

function deleteUser($username) {
    $username = htmlspecialchars(trim($username));
    $users = getAllUsers();
    $file_path = 'data/users.txt';

    $file = fopen($file_path, 'w');
    if ($file) {
        $result = true;
        foreach ($users as $user) {
            if ($user['username'] != $username) {
                $write_result = fwrite($file, "{$user['username']}|{$user['password']}|{$user['role']}\n");
                if ($write_result === false) {
                    $result = false;
                    break;
                }
            }
        }
        fclose($file);
        return $result;
    } else {
        error_log("Failed to open file $file_path for writing.");
        return false;
    }
}

function addProduct($product_name, $price) {
    $product_name = htmlspecialchars(trim($product_name));
    $price = filter_var(trim($price), FILTER_VALIDATE_FLOAT);
    $file_path = 'data/products.txt';

    $file = fopen($file_path, 'a');
    if ($file) {
        $result = fwrite($file, "$product_name|$price\n");
        fclose($file);
        return $result !== false;
    } else {
        error_log("Failed to open file $file_path for appending.");
        return false;
    }
}

function purchaseProduct($username, $product_name, $quantity, $price) {
    $username = htmlspecialchars(trim($username));
    $product_name = htmlspecialchars(trim($product_name));
    $quantity = filter_var(trim($quantity), FILTER_VALIDATE_INT);
    $price = filter_var(trim($price), FILTER_VALIDATE_FLOAT);
    $date = date('Y-m-d H:i:s');
    $file_path = 'data/transactions.txt';

    $file = fopen($file_path, 'a');
    if ($file) {
        $result = fwrite($file, "$product_name|$quantity|$price|$date\n");
        fclose($file);
        return $result !== false;
    } else {
        error_log("Failed to open file $file_path for appending.");
        return false;
    }
}

?>
