Imports MySql.Data.MySqlClient
<?php
$tbnombre=$objDatos->tbNombreOriginal;
if($tbnombre=="usuario" || $tbnombre=="usuarios"){ ?>
Imports System.Security.Cryptography
Imports System.Text	 
<?php }?>

Public Class M<?=$objDatos->tbNombreCamello."\n";?>
<?php 
echo $objDatos->camposPrivate;
echo "\n";
?>
'=====================================================
Private objConectar As New MConectar()
Private con = objConectar.conexion
'=====================================================
Public Sub New(<?=substr($objDatos->camposConstruct,0,-1);?>)
<?=substr($objDatos->camposThis,0,-1);?>

End Sub

Public Function leerDatosRegistro(ByVal campo As String, ByVal valor As String, Optional ByVal si_extra As Boolean = False, Optional ByVal bus_extra As String = Nothing) As M<?=$objDatos->tbNombreCamello."\n"?>
        Dim sql As String = Nothing
        If si_extra = False Then
            sql = "SELECT * FROM <?=$objDatos->tbNombreOriginal?> WHERE " & campo & "='" & valor & "'"
        Else
            sql = "SELECT * FROM <?=$objDatos->tbNombreOriginal?> WHERE " & campo & "='" & valor & "'" & bus_extra
        End If
        Dim cmd As New MySqlCommand(sql, con)
        If con.State = ConnectionState.Closed Then
            con.Open()
        End If
        Dim obj<?=$objDatos->tbNombreCamello?> As New M<?=$objDatos->tbNombreCamello."\n"?>
        Dim reader As MySqlDataReader = cmd.ExecuteReader
        If reader.HasRows Then
            While reader.Read
               <?=$objDatos->camposRead?>
            End While
        Else
        	<?="obj".$objDatos->tbNombreCamello.".Pk_".$objDatos->tbNombreOriginal."=0\n"?>
        End If
        reader.Close()
        cmd.Dispose()

        Return obj<?=$objDatos->tbNombreCamello."\n"?>
End Function

''==============================================INSERTAR============================================================

Public function insertar(ByVal obj<?=$objDatos->tbNombreCamello." As M".$objDatos->tbNombreCamello?>) As Integer
		Dim estado As Integer = 0
        Dim cmd As New MySqlCommand("<?=$objDatos->camposInsert?>)", con)

        With cmd
        	<?=$objDatos->camposParameter?>
        End With

        Try
            cmd.Connection.Open()
            estado = cmd.ExecuteNonQuery()
            cmd.Dispose()
            con.Close()
        Catch falla As MySqlException
            estado = 0
            MsgBox(falla.Message)
        End Try
        Return estado
    End Function
    
 ''==============================================ACTUALIZAR============================================================
 
 Public Function actualizar(ByVal obj<?=$objDatos->tbNombreCamello?> As M<?=$objDatos->tbNombreCamello?>) As Integer
        Dim estado As Integer = 0
        Dim cmd As New MySqlCommand("<?=$objDatos->camposUpdate?>", con)

        With cmd
            <?=$objDatos->camposParameter?>
        End With

        Try
            cmd.Connection.Open()
            estado = cmd.ExecuteNonQuery()
            cmd.Dispose()
            con.Close()
        Catch falla As MySqlException
             estado = 0
            MsgBox(falla.Message)
        End Try
        Return estado
    End Function
 
      
<?php
 $tbnombre=$objDatos->tbNombreOriginal;
 if($tbnombre=="usuario" || $tbnombre=="usuarios"){
?>
 ''==============================================COMPROBAR USUSARIO============================================================
  Public Function comprueba<?=$objDatos->tbNombreCamello?>(login As String, password As String, conexion As MySqlConnection) As M<?=$objDatos->tbNombreCamello."\n"?>
        Dim cmd As New MySqlCommand("select * from <?=$objDatos->tbNombreOriginal?> where login=?login and password=?password", conexion)

        With cmd
            .Parameters.AddWithValue("?login", login)
            .Parameters.AddWithValue("?password", generarClaveSHA1(password))
        End With

        Dim obj<?=$objDatos->tbNombreCamello?> As New M<?=$objDatos->tbNombreCamello."\n"?>
        cmd.Connection.Open()

        Dim reader As MySqlDataReader = cmd.ExecuteReader
        If reader.HasRows Then
            While reader.Read
            	<?=$objDatos->camposRead?>
            End While
        Else
            obj<?=$objDatos->tbNombreCamello?>.<?=$objDatos->pkTabla?> = 0
        End If
        reader.Close()
        cmd.Dispose()
        conexion.Close()

        Return obj<?=$objDatos->tbNombreCamello."\n"?>
    End Function

''==============================================================
Private Function generarClaveSHA1(ByVal clave As String) As String
        Dim enc As New UTF8Encoding
        Dim data() As Byte = enc.GetBytes(clave)
        Dim result() As Byte
        Dim sha As New SHA1CryptoServiceProvider
        result = sha.ComputeHash(data)
        Dim sb As New StringBuilder
        For i As Integer = 0 To result.Length - 1
            If result(i) < 16 Then
                sb.Append("0")
            End If
            sb.Append(result(i).ToString("x"))
        Next
        Return sb.ToString.ToUpper
    End Function
    
     
 <?php
 } // end tb_user ?>
 
 
 End class
 
