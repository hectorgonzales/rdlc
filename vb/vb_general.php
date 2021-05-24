Imports MySql.Data.MySqlClient
Public Class MGenerales

Public Function listarSQL(ByVal sql As String, ByVal nombre_tabla As String) As DataTable
        Dim cmd As New MySqlCommand(sql, con)
        cmd.Connection.Open()
        Dim da As New MySqlDataAdapter(cmd)
        Dim dt As New DataTable
        dt.TableName = nombre_tabla
        Dim dv As New DataView
        da.Fill(dt)
        Return dt
        cmd.Dispose()
        con.Close()
End Function
    
    
 Public Function eliminar(tabla As String, campo As String, valor As String) As Integer
        Dim estado As Integer = 0
        Dim cmd As New MySqlCommand("DELETE from " & tabla & " where " & campo & "=?valor", con)

        With cmd
            .Parameters.AddWithValue("?valor", valor)
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
    

End Class

'==============POR VERIFICAR

Public Function DValorParametro(ByVal parametro As String) As String
        If con.State = ConnectionState.Closed Then
            con.Open()
        End If
        Dim cmd As New MySqlCommand("select valor from parametro where parametro='" & parametro & "'", con)
        cmd.ExecuteScalar()
        Dim valor_parametro As String = cmd.ExecuteScalar()
        cmd.Dispose()
        con.Close()

        If Not String.IsNullOrEmpty(valor_parametro) Then
            Return valor_parametro
        Else
            Dim msg_error As String = "No se encontro el parametro: " & parametro
            Return msg_error
        End If
    End Function

    Public Function DValorUnicoDeCampo(ByVal tabla As String, ByVal campo_devolver As String, ByVal campo_condicion As String, ByVal valor_condicion As String) As String
        If con.State = ConnectionState.Closed Then
            con.Open()
        End If

        Dim cmd As New MySqlCommand("select " & campo_devolver & " from " & tabla & " where " & campo_condicion & "='" & valor_condicion & "'", con)
        cmd.ExecuteScalar()
        Dim valor As Object = Convert.ToString(cmd.ExecuteScalar()) '--convert para los campos dbnull
        'Convert.ToString(valor)

        cmd.Dispose()
        con.Close()

        'If Not String.IsNullOrEmpty(valor) Then
        Return valor
        'Else
        '    Dim msg_error As String = "No se encontro el valor: " & valor_condicion
        '    Return msg_error
        'End If
    End Function

    Public Function DVerificarSiExiste(ByVal tabla As String, ByVal campo_condicion As String, ByVal valor_condicion As String) As Boolean
        If con.State = ConnectionState.Closed Then
            con.Open()
        End If
        Dim cmd As New MySqlCommand("SELECT (COUNT(*)>0) existe from " & tabla & " where " & campo_condicion & "='" & valor_condicion & "'", con)
        Return Convert.ToBoolean(cmd.ExecuteScalar())

    End Function

    Public Function DUltimoPkInsertado(ByVal tabla As String, ByVal campo_pk As String) As Integer
        If con.State = ConnectionState.Closed Then
            con.Open()
        End If
        Dim cmd As New MySqlCommand("SELECT MAX(" & campo_pk & ") FROM " & tabla, con)
        cmd.ExecuteScalar()
        Dim ultimoPk As Integer = CInt(cmd.ExecuteScalar())
        Return ultimoPk

        cmd.Dispose()
        con.Close()
    End Function