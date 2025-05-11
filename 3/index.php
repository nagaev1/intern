<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="" method="POST">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" placeholder="Name">
            <label for="age">Возраст</label>
            <input type="number" id="age" name="age" placeholder="Age">
            <label for="gender">Пол</label>
            <select name="gender" id="gender">
                <option value="man">Man</option>
                <option value="women">Wowan</option>
            </select>
            <input type="submit" name="submit">
        </form>
    </div>
    <div>
        <?php
        if (isset($_POST['submit'])) {

            $name = $_POST["name"];
            $age = $_POST['age'];
            $gender = $_POST['gender'];

            echo "
            Имя: {$name} /
            Возраст: {$age} " . ($age < 20 || $age > 80 ? "врешь" : "Да ты староват") . "/
            Пол: $gender </br>
            Приветствую " . ($gender == 'man' ? 'Мистер' : "Мадам");
        } else {
            echo "Введите данные";
        }
        ?>

    </div>
</body>

</html>