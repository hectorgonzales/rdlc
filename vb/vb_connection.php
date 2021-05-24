Imports MySql.Data.MySqlClient
Public Class MConectar
    Private Property server As String = "<?=$objDatos->server?>"
    Private Property port As String = "3306"
    Private Property user As String = "<?=$objDatos->user?>"
    Private Property password As String = "<?=$objDatos->password?>"
    Private Property db As String = "<?=$objDatos->database?>"
    Const FICHERO As String = "_d3.ini"
    Public Property con As MySqlConnection

    Public Sub New()
        Dim ip As String = Nothing
        If (My.Computer.FileSystem.FileExists(FICHERO)) Then
            ip = My.Computer.FileSystem.ReadAllText(FICHERO)
        Else
            ip = "0.0.0.0"
        End If

        con = New MySqlConnection("server='" & ip & "'; Port=" & port & ";uid='" & user & "';password='" & password & "';database='" & db & "';Allow User Variables=True;")
    End Sub

    Public Sub New(var_server As String, Optional var_port As String = "3306")
        con = New MySqlConnection("server='" & var_server & "'; Port=" & var_port & ";uid='" & user & "';password='" & password & "';database='" & db & "';Allow User Variables=True;")
    End Sub
    Public Function conexion() As MySqlConnection
        'If con.State = ConnectionState.Closed Then
        '    con.Open()
        'End If
        Return con
    End Function

End Class