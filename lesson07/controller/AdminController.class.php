<?php

/**
 * Class AdminController
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

namespace App\Controller;

class AdminController extends Controller
{
    protected $controls = [
        'pages' => 'Page',
        'orders' => 'Order',
        'categories' => 'Category',
        'goods' => 'Good'
    ];

    public $title = 'admin';
    
    public function index($data)
    {
       $answer = $this->adminCheckAuth($data);

        return [
            'controls' => $this->controls,
            'info' => $answer['info'],
            'status' => $answer['status'],
            'role' => $answer['role']
        ];
    }

    public function control($data)
    {
        $answer = $this->adminCheckAuth($data);

        // Сохранение
        $actionId = $this->getActionId($data);
        if ($actionId['action'] === 'save') {
            $fields = [];

            foreach ($_POST as $key => $value) {
                $field = explode('_', $key, 2);
                if ($field[0] == $actionId['id']) {
                    $fields[$field[1]] = $value;
                }
            }
        }

        if ($actionId['action'] === 'create') {
            $fields = [];
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 4) == 'new_') {
                    $fields[str_replace('new_', '', $key)] = $value;
                }
            }
        }

        switch($actionId['action']) {
            case 'create':
                $query = 'INSERT INTO ' . $data['id'] . ' ';
                $keys = [];
                $values = [];
                foreach ($fields as $key => $value) {
                    $keys[] = $key;
                    $values[] = '"' . $value . '"';
                }

                $query .= ' (' . implode(',', $keys) . ') VALUES ( ' . implode(',', $values) . ')';
                \App\Lib\db::getInstance()->Query($query);
                break;
            case 'save':
                $query = 'UPDATE ' . $data['id'] . ' SET ';
                foreach ($fields as $field => $value) {
                    $query .= $field . ' = "' . $value . '",';
                }
                $query = substr($query, 0, -1) . ' WHERE id = :id';

                \App\Lib\db::getInstance()->Query($query, ['id' => $actionId['id']]);
                break;
            case 'delete':
                \App\Lib\db::getInstance()->Query('UPDATE ' . $data['id'] . ' SET status=:status WHERE id = :id', ['id' => $actionId['id'], 'status' => Status::DELETED]);
                break;
        }
        $fields = \App\Lib\db::getInstance()->Select('desc ' . $data['id']);
        $_items = \App\Lib\db::getInstance()->Select('select * from ' . $data['id']);
        $items = [];

        foreach ($_items as $item) {
            $class = '\\App\\Model\\' . $this->controls[$data['id']];
            $tmp = new $class($item);
            $items[] = (array)$tmp;
        }

        $headerField = [];

        foreach ($fields as $key => $field) {

            $property = \App\Model\Category::getProperties()[$field['Field']];

            if ( !isset($property['show']) || $property['show'] ) {
                $headerField[] = $field;
            }
        }

        return [
            'name' => $data['id'],
            'fields' => $headerField,
            'items' => $items,
            'info' => $answer['info'],
            'status' => $answer['status'],
            'role' => $answer['role']
        ];
    }

    protected function getActionId($data)
    {

        $id = 0;
        $action = '';

        foreach ($_POST as $key => $value) {
            if (strpos($key, '__save_') === 0) {
                $id = explode('__save_', $key)[1];
                $action = 'save';
                break;
            }
            if (strpos($key, '__delete_') === 0) {
                $id = explode('__delete_', $key)[1];
                $action = 'delete';
                break;
            }
            if (strpos($key, '__create') === 0) {
                $action = 'create';
                $id = 0;
            }
        }
        return ['id' => $id, 'action' => $action];
    }
}
