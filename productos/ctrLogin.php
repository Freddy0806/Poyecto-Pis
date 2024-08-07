<?php
class Ctrlogin {
    public function login(){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    session_start();
                    try{
                        $post = (object) $_POST;
                        $data = [
                            "idTemporal" => uniqid(),
                            "email" => $post->email,
                            "password" => $post->password
                        ];

                        if($data["email"] == "pis@gmail.com"){
                            if($data["password"] == "pis"){
                                $_SESSION["productos"] = $data;
                                return array(
                                    "resp"      => true,
                                    "mensaje"   => "Usuario ingresado",
                                    'data' => $_SESSION["productos"]
                                ); 
                            }
                        }

                        return array(
                            "resp"      => false,
                            "mensaje"   => "Usuario o contraseña no es el correcto"
                        ); 

                    }catch (Exception $e) {
                        return array(
                            "resp"      => false,
                            "mensaje"   => $e->getMessage()
                        );
                    }
                }else{
                    return [
                        "resp" => false, 
                        "message"=>"No tienes acceso, error 0020"
                    ];
                }
            }

            public function logout(){
                session_start();
                session_destroy();
                return [
                    "resp" => true
                ];
            }
        
        
} 