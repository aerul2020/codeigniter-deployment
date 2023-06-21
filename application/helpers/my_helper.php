<?php
function isAuthenticated()
{
    $ci =& get_instance();
    return $ci->session->is_logged_in === TRUE;
}

function getAutoCode($table, $column, $code)
{
    $ci =& get_instance();
    $query = "SELECT MAX($column) AS maxcode FROM $table";
    $query = $ci->db->query($query);

    $result_code = "";
    if ($query->num_rows() > 0) {
        $maxcode = $query->row()->maxcode;
        if ($maxcode !== '') {
            $maxcode = explode("-", $maxcode);
            $maxcode = end($maxcode);
            $maxcode = (int)$maxcode + 1;

            $addZero = "";
            if (strlen($maxcode) == 1) {
                $addZero = "000";
            } elseif (strlen($maxcode) == 2) {
                $addZero = "00";
            } elseif (strlen($maxcode) == 3) {
                $addZero = "0";
            }
            $result_code = $code . "-" . $addZero . $maxcode;
        } else {
            $result_code = $code . "-0001";
        }
    } else {
        $result_code = $code . "-0001";
    }
    return $result_code;
}

function getUser($index = null)
{
    if (isset($_SESSION['user'])) {
        $userSession = $_SESSION['user'];

        $userData = getData('pengguna', '*', [
            'id_pengguna' => $userSession->id_pengguna
        ]);
        $user = $userData[0];

        if ($userSession->nama_lengkap !== $user->nama_lengkap || $userSession->username !== $user->username || $userSession->email !== $user->email || $userSession->foto !== $user->foto) {
            //Change session value
            $_SESSION['user'] = $user;
        }
        return $_SESSION['user']->{$index};
    }

    return null;
}

function getData($tableName, $columns = '*', $where = [])
{
    $ci =& get_instance();
    $sql = "SELECT $columns FROM $tableName";

    if (count($where) !== 0) {
        $key = array_keys($where)[0];
        $val = array_values($where)[0];
        $sql .= " WHERE $key = '$val'";
    }

    return $ci->db->query($sql)->result();
}

function showBreadCrumb()
{
    $ci =& get_instance();
    $html = "<div class='section-header-breadcrumb'>";
    $totalSegments = $ci->uri->total_segments();
    $class = "breadcrumb-item ";
    $html .= "<div class='$class'><a href='" . base_url('dashboard') . "'>Dashboard</a></div>";
    for ($i = 1; $i <= $totalSegments; $i++) {
        $uri = $ci->uri->segment($i);
        $label = ucfirst(str_replace("-", " ", $uri));

        if ($uri === 'edit' || $uri === 'update') {
            $uri_before = $ci->uri->segment($i - 1);
            $uri_after = $ci->uri->segment($i + 1);
            $uri = $uri_before . "/edit/" . $uri_after;
        }

        if ($uri === "create") {
            $label = "Tambah";
        }

        if ($uri === "change-password") {
            $label = "Ubah Password";
        }

        if ($i === $totalSegments) {
            $class .= " active";
            $html .= "<div class='$class'>$label</div>";
        } else {
            $html .= "<div class='$class'><a href='" . base_url($uri) . "'>" . $label . "</a></div>";
        }
    }

    $html .= "</div>";

    return $html;
}

function setArrayMessage($type, $actionType, $dataType)
{
    $messageText = "";
    $messageType = "";
    $messageStatus = ($type == 'success') ? " berhasil " : " gagal ";

    if ($actionType === 'insert') {
        $messageType = " disimpan!";
    } else if ($actionType === 'update') {
        $messageType = " diperbarui!";
    } else if ($actionType === 'delete') {
        $messageType = " dihapus!";
    }
    $messageText = "Data " . $dataType . $messageStatus . $messageType;

    return [
        'type' => $type,
        'text' => $messageText,
    ];
}

function redirectBack()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: http://' . $_SERVER['SERVER_NAME']);
    }
    exit;
}

function dd($data)
{
    if (is_array($data)) {
        print_r($data);
        die();
    } else if (is_string($data)) {
        echo $data;
        die();
    }
}