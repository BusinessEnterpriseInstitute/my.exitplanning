<?php

class DBQueries{

    public static function get_user_id($user)
    {
        $does_exist = db_select('oauth_server_sso_token','n')
          ->fields('n')
          ->condition('user_id_val', $user->uid,'=')
          ->execute()
          ->fetchAssoc();

          return $does_exist;
    }
    public static function insert_user_in_table($user)
    {
        db_insert('oauth_server_sso_token')
        -> fields(array(
           'user_id_val' => $user->uid,
             ))
        ->execute();
    }
    public static function update_user_in_table($user)
    {
        db_update('oauth_server_sso_token')
          -> fields(array(
            'user_id_val' => $user->uid,
            ))
          ->execute();
    }
    public static function insert_code_from_user_id($code, $user)
    {
        $num_updated = db_update('oauth_server_sso_token')
        ->fields(array(
          'auth_code' => $code,
        ))
        ->condition('user_id_val', $user->uid, '=')
        ->execute();

        return $num_updated;
    }
    public static function get_code_from_user_id($request_code)
    {
        $user_id = db_select('oauth_server_sso_token', 'user_id_val')->fields('user_id_val')
                ->condition('auth_code', $request_code, '=')
                ->execute()
                ->fetchAssoc();

        return $user_id;
    }
    public static function insert_code_expiry_from_user_id($code_time,$user)
    {
        $authCodeTime = db_update('oauth_server_sso_token')
          ->fields(array(
            'auth_code_expiry_time' => $code_time,
          ))
            ->condition('user_id_val', $user->uid, '=')
            ->execute();

        return $authCodeTime;
    }
    public static function get_same_code_as_received($request_code)
    {
        $code = db_select('oauth_server_sso_token', 'auth_code')->fields('auth_code')
                ->condition('auth_code', $request_code, '=')
                ->execute()
                ->fetchAssoc();
      $code = $code['auth_code'];
      return $code;
    }
    public static function insert_access_token_with_user_id($user_id, $access_token)
    {
        $access_token_inserted = db_update('oauth_server_sso_token')
        ->fields(array(
          'access_token' => $access_token,
        ))
        ->condition('user_id_val', $user_id, '=')
        ->execute();
        return $access_token_inserted;
    }
    public static function insert_access_token_expiry_time($user_id,$req_time)
    {
        $accessToken_expiry_time_inserted = db_update('oauth_server_sso_token')
        ->fields(array(
          'access_token_request_time' => $req_time,
        ))
        ->condition('user_id_val', $user_id, '=')
        ->execute();
        return $accessToken_expiry_time_inserted;
    }
    public static function get_user_id_from_access_token($access_token_received)
    {
        $user_id = db_select('oauth_server_sso_token', 'user_id_val')
                ->fields('user_id_val')
                ->condition('access_token', $access_token_received, '=')
                ->execute()
                ->fetchAssoc();
        return $user_id;
    }
    public static function get_access_token_request_time_from_user_id($user_id)
    {
        $req_time = db_select('oauth_server_sso_token', 'access_token_request_time')->fields('access_token_request_time')
        ->condition('user_id_val', $user_id, '=')
        ->execute()
        ->fetchAssoc();

        return $req_time;
    }
}
?>