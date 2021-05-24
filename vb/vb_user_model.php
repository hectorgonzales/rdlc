sss
Imports MySql.Data.MySqlClient
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
 
 End class