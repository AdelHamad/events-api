<?php

function get_event_by_id($id)
{
    global $db;
    isset($id) ? $db->where("id", $id) : null;
    $results = $db->get("events");
    return $results;
}

function get_events($page, $size)
{
    $page *= $size;
    global $db;
    $db->orderBy("id","Desc");
    $results = $db->withTotalCount()->get('events', Array ($page, $size));
    return $results;
}

function insert_event($data)
{
    global $db;
    $id = $db->insert('events', $data);
    if ($id) return $id;
    else return false;
}

function delete_event($id)
{
    global $db;
    $id = make_safe($id);
    $db->where('id', $id);
    $result = $db->delete('events');
    if ($result) {
        return $id;
    } else return false;
}

function update_event($id, $data)
{
    global $db;
    $id = make_safe($id);
    $db->where("id", $id);
    $db->update('events', $data); // limit to 1 row
    $is_updated = $db->count; //affected rows
    if ($is_updated > 0) return $id;
    else return false;
}

function signup($data)
{
    global $db;
    $id = $db->insert('users', $data);
    if ($id) return $id;
    else return false;
}


function signin($username, $password)
{
    global $db;
    $db->where("username", $username);
    $db->where("password", $password);
    $results = $db->getOne("users");
    return $results;
}
