<?php
require_once 'helpers.php';
$categories = [
    'inbox' => 'Входящие',
    'studies' => 'Учеба',
    'work' => 'Работа',
    'housework' => 'Домашние дела',
    'auto' => 'Авто'];
//двухмерный массив ($tasks)
$tasks = [
    [
    'name' => 'Собеседование в IT компании',
    'date' => '01.12.2019',
    'category' => $categories['work'],
    'done' => false
    ],
    [
    'name' => 'Выполнить тестовое задание',
    'date' => '25.12.2019',
    'category' => $categories['work'],
    'done' => false
    ],
    [
    'name' => 'Сделать задание первого раздела',
    'date' => '21.12.2019',
    'category' => $categories['studies'],
    'done' => true
    ],
    [
    'name' => 'Встреча с другом',
    'date' => '22.12.2019',
    'category' => $categories['inbox'],
    'done' => false
    ],
    [
    'name' => 'Купить корм для кота',
    'date' => null,
    'category' => $categories['housework'],
    'done' => false
    ],
    [
    'name' => 'Заказать пиццу',
    'date' => null,
    'category' => $categories['housework'],
    'done' => false
    ]
];

$show_complete_tasks = rand(0, 1);

date_default_timezone_set('Europe/Moscow');
/**
 * Проверка задач в дедлайне
 * @param string $date_time дата выполнения задачи
 * @return boolean возвращаем true, если задачи осталось < 24 h
 */

function is_hot_task($date_time) {
    if ($date_time == null)
    { return false; }
$time_limit = false;
$current_time = date('d.m.Y');
$task_time = date($date_time);
$task_time = strtotime($task_time);
$current_time = date("d.m.Y", strtotime($current_time.'- 1 days'));
$current_time = strtotime($current_time);

if ($current_time > $task_time) {
    $time_limit = true;
    }
    return $time_limit;
}
/* ДЕБАГ ДЛЯ ПРОВЕРКИ!
<?php echo "<pre>"; print_r(is_hot_task($task['date'])); echo "<pre>"; ?>
 */
/**
 * посчитать количество задач в конкретной категории
 *
 * @param array $tasks список всех задач
 * @param string $category_title индефикатор категории
 * @return int количество задач в конкретной категории
 */
function count_tasks($tasks, $category_title) {
    $count_task = 0;
    foreach ($tasks as $task) {
        if ($task['category'] === $category_title) {
            $count_task++;
        }
    }
    return $count_task;
}

$main_content = include_template("main.php", [
    'categories' => $categories,
    'tasks' => $tasks,
    'show_complete_tasks' =>$show_complete_tasks,
]);
$layout = include_template("layout.php", [
    'main_content' => $main_content,
    'page_title' => 'Главная страница',
    'user_name' => 'Константин',
]);
print($layout);
