Imports MySql.Data.MySqlClient
Public Class clases
    '================QITAR CHECKED A BOTONES DE MDI=========================================
    Public Shared Sub quitar_seleccion_menu_prin()

        My.Forms.frm_menu.rb_usuarios.Checked = False


        With My.Forms.frm_menu
            .MdiParent = frm_mdi
            .Show()
        End With
        op_frm = Nothing
    End Sub


    '================CARGAR REGISTROS=========================================
    Public Shared Sub cargar_registros(ByVal ds As DataSet, ByVal da As MySqlDataAdapter, ByVal dv As DataView, ByVal tb As String, ByVal dg As DataGridView)
        Try
            da.Fill(ds, tb)
            Dim cmdb = New MySqlCommandBuilder(da)
            dv.Table = ds.Tables(tb)
            dg.DataSource = dv
            '-------barra estado--------------------

            'clases.total_registros(ds.Tables(tb), dg)

        Catch ex As Exception
            MsgBox(ex.ToString)
        End Try

    End Sub

    '================BUSCAR REGISTO SI NO EXISTE --> INSERTAR =========================================
    Public Shared Function buscar_si_existe(ByVal dg As DataGridView, ByVal campo1 As String, ByVal valor1 As String, Optional ByVal mascampos As Boolean = False, Optional ByVal campo2 As String = Nothing, Optional ByVal valor2 As String = Nothing)
        Dim existe As Boolean = False

        If mascampos = True Then
            For Each item As DataGridViewRow In dg.Rows
                If item.Cells(campo1).Value = valor1 And item.Cells(campo2).Value = valor2 Then
                    existe = True
                    Exit For
                End If
            Next
        Else
            For Each item As DataGridViewRow In dg.Rows
                If item.Cells(campo1).Value = valor1 Then
                    existe = True
                    Exit For
                End If
            Next
        End If
        Return existe

    End Function

    '================BUSCAR REGISTO SI NO EXISTE CON AND O OR--> INSERTAR =========================================
    Public Shared Function buscar_si_existe_bool(ByVal dg As DataGridView, ByVal campo1 As String, ByVal valor1 As String, Optional ByVal bool As String = "and", Optional ByVal campo2 As String = Nothing, Optional ByVal valor2 As String = Nothing)
        Dim existe As Boolean = False

        If bool = "and" Then
            For Each item As DataGridViewRow In dg.Rows
                If item.Cells(campo1).Value = valor1 And item.Cells(campo2).Value = valor2 Then
                    existe = True
                    Exit For
                End If
            Next
        Else
            For Each item As DataGridViewRow In dg.Rows
                If item.Cells(campo1).Value = valor1 Or item.Cells(campo2).Value = valor2 Then
                    existe = True
                    Exit For
                End If
            Next
        End If
        Return existe

    End Function

    '================BUSCAR REGISTO DETAllE  SI NO EXISTE --> INFORMA (SIN DV) =========================================
    Public Shared Function buscar_registro_detalle(ByVal dg As DataGridView, ByVal campo As String, ByVal pk As Integer)
        Dim existe As Boolean = False
        For Each item As DataGridViewRow In dg.Rows
            If item.Cells(campo).Value = pk Then
                existe = True
                Exit For
            End If
        Next
        Return existe
    End Function


    '================INSERTAR REGISTO=========================================
    Public Shared Sub insertar_registro(ByVal ds As DataSet, ByVal dt As String, ByVal da As MySqlDataAdapter, ByVal campos() As Object, Optional ByVal msg_error As String = "", Optional ByVal con_pk As Boolean = False)
        Try
            Dim dr As DataRow = ds.Tables(dt).NewRow
            Dim tc As Integer = campos.Length
            If con_pk = True Then
                For c As Integer = 0 To tc - 1
                    dr(ds.Tables(dt).Columns(c).ColumnName) = campos(c)
                Next
            Else
                For c As Integer = 1 To tc
                    dr(ds.Tables(dt).Columns(c).ColumnName) = campos(c - 1)
                Next
            End If
            ds.Tables(dt).Rows.Add(dr)
            If con.State = ConnectionState.Closed Then con.Open()
            da.Update(ds, dt)
            ds.Tables(dt).AcceptChanges()
            con.Close()
        Catch ex As Exception
            MsgBox(ex.ToString)
            'MsgBox(msg_error)
        End Try

    End Sub

    '================ACTUALIZAR REGISTO=========================================
    Public Shared Sub actualizar_registro(ByVal ds As DataSet, ByVal da As MySqlDataAdapter, ByVal dv As DataView, ByVal tb As String, ByVal dg As DataGridView, Optional ByVal mas_campos As Boolean = False, Optional ByVal campos_extras As String = "")
        Dim drv As DataRowView = dv(dg.CurrentRow.Index)
        If mas_campos = True Then
            Dim cex() = Split(campos_extras, ",")
            For i As Integer = 0 To UBound(cex)
                Dim campo_valor As String = cex(i)
                Dim array_campo_valor() As String = Split(campo_valor, "=")
                drv(array_campo_valor(0)) = array_campo_valor(1)
            Next
        End If

        drv.EndEdit()
        da.Update(ds, tb)
        ds.Tables(tb).AcceptChanges()
        '---------------------------------------------------
        'Dim drv As DataRowView = dv(dg.CurrentRow.Index)
        'drv.EndEdit()
        'da.Update(ds, tb)
        'ds.Tables(tb).AcceptChanges()
    End Sub

    '================ELIMINAR REGISTO=========================================
    Public Shared Sub eliminar_registro(ByVal dg As DataGridView, ByVal da As MySqlDataAdapter, ByVal ds As DataSet, ByVal tb As String, Optional ByVal titulo As String = "Registro")
        Try

            dg.Rows.Remove(dg.CurrentRow)
            da.Update(ds, tb)
            ds.Tables(tb).AcceptChanges()

        Catch ex As Exception
            MsgBox("No se pudo eliminar, vuelva a intentarlo")
        End Try

    End Sub
    '================ELIMINAR REGISTO CON SQL=========================================
    Public Shared Sub eliminar_registro_sql(ByVal dv As DataView, ByVal ds As DataSet, ByVal dg As DataGridView, ByVal campo_pk As String, ByVal tb As String)
        Dim pk As Integer = dv(dg.CurrentRow.Index)(campo_pk)
        Dim cmd As New MySqlCommand("delete from " & tb & " where " & campo_pk & "='" & pk & "'", con)
        con.Open()
        cmd.ExecuteNonQuery()
        dg.Rows.Remove(dg.CurrentRow)
        ds.Tables(tb).AcceptChanges()
        con.Close()
    End Sub
    '================QUITAR REGISTO=========================================
    Public Shared Sub quitar_registro(ByVal dg As DataGridView, Optional ByVal titulo As String = "Registro")
        Try
            ' If MsgBox("desea quitar el registro?", 292, titulo) = 6 Then
            dg.Rows.Remove(dg.CurrentRow)
            'End If
        Catch ex As Exception
            MsgBox("No se pudo quitar el registro, vuelva a intentarlo")
        End Try

    End Sub

    '=================== HEAD MAYUS ========================================
    Public Shared Sub dg_head_mayus(ByVal dg As DataGridView, ByVal campos_mostrar() As String)

        Dim x As Integer = 0
        For Each cols In dg.Columns
            'MsgBox(campos_mostrar(x))
            cols.headerText = campos_mostrar(x)
            x += 1
        Next
    End Sub

    '=================== BUSCAR CAMPO SELECCIONADO ========================================
    Public Shared Sub buscar_campo_seleccionado(ByVal dg As DataGridView, ByVal lb As Label)
        tipo_campo = dg.Columns(dg.CurrentCell.ColumnIndex).ValueType.Name
        'id_campo = dg.CurrentCell.ColumnIndex

        id_campo = dg.Columns(dg.CurrentCell.ColumnIndex).DisplayIndex

        Dim campo_lb As String = ""
        Dim campo_seleccionado = dg.Columns(dg.CurrentCell.ColumnIndex).HeaderText

        If InStr(campo_seleccionado, "(") Then
            campo_lb = campo_seleccionado.Substring(0, campo_seleccionado.Length - 4)
        Else
            campo_lb = campo_seleccionado
        End If
        lb.Text = msg_buscar & campo_lb.ToUpper & ":"

    End Sub

    '=================== BUSCAR CON FILTRO CREADO========================================
    Public Shared Sub buscar_registros2(ByVal txt As TextBox, ByVal dv As DataView, ByVal dg As DataGridView, ByVal campos() As Object, Optional ByVal si_extra As Boolean = False, Optional ByVal bus_extra As String = Nothing)

        '************************************************************************************************
        '********* devuelve 
        '********* BUSQEUDA EXTRA: en casos de and pegados texto + and obligatorio 
        '********* EJEMPLO EXTRA:  clases.buscar_registros2(Me.txt_buscar, dv_necesidad, dg_base, campos_tabla, True, "and fk_area_proyecto='" & fk_area_proyecto & "'")
        '********* EJEMPLO:
        '********* USO:  clases.buscar_registros2(Me.txt_buscar, dv_producto, dg_base, campos_tabla)
        '*********       
        '********* UBICACION: evento TextChanged del txt_buscar
        '******************** ****************************************************************************

        '------------------------------------------------------------------------------------------------
        If txt.Text.Length <> 0 Then '-- IF 1
            Dim filtro As String = ""
            Dim texto_buscar As String = txt.Text '--- VALOR INGRESADO  -  EN EL TXT
            Dim tipo_campo_escrito = ""

            If InStr(texto_buscar, "+") Then '-- IF 2 -- si en VALOR INGRESADO existe un + 
                Dim matriz_campos() As String = Split(texto_buscar.Replace(" ", ""), "+") '--- divide el VI "nasca+peru" y pasa a matriz MATRIZ CAMPOS - contiene los TXT 
                For n As Integer = 1 To matriz_campos.Length - 1 '---empieza texto+3nasca en 1 osea 2 en matriz 

                    Dim c, t As String
                    c = Mid(matriz_campos(n), 1, 1) '-- obtiene el primir caracter despues del + 

                    If c = "" Or Not IsNumeric(c) Then '---- verifica q el 1 caracter es numero o texto
                        'si despues del mas no hay numero no hacer nada
                    Else
                        t = Mid(matriz_campos(n), 2) '--- devuelve el TEXTO despues del munero +3TEXTO

                        tipo_campo_escrito = dg.Columns(campos(c)).ValueType.Name '-- c es el NUMERO de la columnas (1)


                        If tipo_campo_escrito = "String" Then
                            filtro += " and " & campos(c) & " like '%" & t & "%' "
                        Else
                            filtro += " and Convert(" & campos(c) & ", 'System.String') Like '%" & t & "%' "
                        End If

                    End If

                Next '--fin FOR

                'ejemplo: | pro+ <--se lanza 

                If tipo_campo = "String" Then '---lanzar BUSQUEDA FILTRO --- CAMPOS() es la matriz ordenada de la tabla
                    If si_extra = False Then
                        dv.RowFilter = campos(id_campo) & " like '%" & matriz_campos(0) & "%'" & filtro '--matriz campo es el primer TXT de la busqueda
                    Else
                        dv.RowFilter = campos(id_campo) & " like '%" & matriz_campos(0) & "%'" & filtro & bus_extra ' extra
                    End If

                Else
                    If si_extra = False Then
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') like '%" & matriz_campos(0) & "%'" & filtro
                    Else
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') like '%" & matriz_campos(0) & "%'" & filtro & bus_extra ' extra
                    End If

                End If


            Else ''-- IF 2 ' ESTA BUSQUEDA SE REALIZA AL USAR SOLO UN CAMPO AL PRINCIPIO
                If tipo_campo = "String" Then
                    If si_extra = False Then
                        dv.RowFilter = campos(id_campo) & " like '%" & txt.Text & "%'"
                    Else
                        dv.RowFilter = campos(id_campo) & " like '%" & txt.Text & "%'" & bus_extra ' extra
                    End If

                Else
                    If si_extra = False Then
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') Like '%" & txt.Text & "%'"
                    Else
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') Like '%" & txt.Text & "%'" & bus_extra ' extra
                    End If


                End If

            End If '---FIN IF 2-- de SI tiene +

            dg.DataSource = dv

        Else '-- ELSE IF 1

            If tipo_campo = "String" Then
                If si_extra = False Then
                    dv.RowFilter = campos(id_campo) & "<>''"
                Else
                    dv.RowFilter = campos(id_campo) & "<>''" & bus_extra ' extra
                End If


            Else
                If si_extra = False Then
                    dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') <>''"
                Else
                    dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') <>''" & bus_extra ' extra
                End If

            End If

            dg.DataSource = dv
        End If '-- FIN IF 1
    End Sub

    '=================== BUSCAR ========================================
    Public Shared Sub buscar_registros(ByVal txt As TextBox, ByVal dv As DataView, ByVal dg As DataGridView, ByVal campos() As Object, Optional ByVal si_extra As Boolean = False, Optional ByVal bus_extra As String = Nothing)

        '************************************************************************************************
        '********* devuelve 
        '********* BUSQEUDA EXTRA: en casos de and pegados texto + and obligatorio 
        '********* EJEMPLO EXTRA:  clases.buscar_registros(Me.txt_buscar, dv_necesidad, dg_base, campos_tabla, True, "and fk_area_proyecto='" & fk_area_proyecto & "'")
        '********* EJEMPLO:
        '********* USO:  clases.buscar_registros(Me.txt_buscar, dv_producto, dg_base, campos_tabla)
        '*********       
        '********* UBICACION: evento TextChanged del txt_buscar
        '******************** ****************************************************************************

        '------------------------------------------------------------------------------------------------
        If txt.Text.Length <> 0 Then '-- IF 1
            Dim filtro As String = ""
            Dim texto_buscar As String = txt.Text '--- VALOR INGRESADO  -  EN EL TXT
            Dim tipo_campo_escrito = ""

            If InStr(texto_buscar, "+") Then '-- IF 2 -- si en VALOR INGRESADO existe un + 
                Dim matriz_campos() As String = Split(texto_buscar.Replace(" ", ""), "+") '--- divide el VI "nasca+peru" y pasa a matriz MATRIZ CAMPOS - contiene los TXT 
                For n As Integer = 1 To matriz_campos.Length - 1 '---empieza texto+3nasca en 1 osea 2 en matriz 

                    Dim c, t As String
                    c = Mid(matriz_campos(n), 1, 1) '-- obtiene el primir caracter despues del + 

                    If c = "" Or Not IsNumeric(c) Then '---- verifica q el 1 caracter es numero o texto
                        'si despues del mas no hay numero no hacer nada
                    Else
                        t = Mid(matriz_campos(n), 2) '--- devuelve el TEXTO despues del munero +3TEXTO

                        tipo_campo_escrito = dg.Columns(campos(c)).ValueType.Name '-- c es el NUMERO de la columnas (1)


                        If tipo_campo_escrito = "String" Then
                            filtro += " and " & campos(c) & " like '%" & t & "%' "
                        Else
                            filtro += " and Convert(" & campos(c) & ", 'System.String') Like '%" & t & "%' "
                        End If

                    End If

                Next '--fin FOR

                'ejemplo: | pro+ <--se lanza 

                If tipo_campo = "String" Then '---lanzar BUSQUEDA FILTRO --- CAMPOS() es la matriz ordenada de la tabla
                    If si_extra = False Then
                        dv.RowFilter = campos(id_campo) & " like '%" & matriz_campos(0) & "%'" & filtro '--matriz campo es el primer TXT de la busqueda
                    Else
                        dv.RowFilter = campos(id_campo) & " like '%" & matriz_campos(0) & "%'" & filtro & bus_extra ' extra
                    End If

                Else
                    If si_extra = False Then
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') like '%" & matriz_campos(0) & "%'" & filtro
                    Else
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') like '%" & matriz_campos(0) & "%'" & filtro & bus_extra ' extra
                    End If

                End If


            Else ''-- IF 2 ' ESTA BUSQUEDA SE REALIZA AL USAR SOLO UN CAMPO AL PRINCIPIO
                If tipo_campo = "String" Then
                    If si_extra = False Then
                        dv.RowFilter = campos(id_campo) & " like '%" & txt.Text & "%'"
                    Else
                        dv.RowFilter = campos(id_campo) & " like '%" & txt.Text & "%'" & bus_extra ' extra
                    End If

                Else
                    If si_extra = False Then
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') Like '%" & txt.Text & "%'"
                    Else
                        dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') Like '%" & txt.Text & "%'" & bus_extra ' extra
                    End If


                End If

            End If '---FIN IF 2-- de SI tiene +

            dg.DataSource = dv

        Else '-- ELSE IF 1

            If tipo_campo = "String" Then
                If si_extra = False Then
                    dv.RowFilter = campos(id_campo) & "<>''"
                Else
                    dv.RowFilter = campos(id_campo) & "<>''" & bus_extra ' extra
                End If


            Else
                If si_extra = False Then
                    dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') <>''"
                Else
                    dv.RowFilter = "Convert(" & campos(id_campo) & ", 'System.String') <>''" & bus_extra ' extra
                End If

            End If

            dg.DataSource = dv
        End If '-- FIN IF 1
    End Sub


    ''=================== ORDENAR CAMPOS GRID ========================================
    Public Shared Sub ordenar_campos(ByVal dv_parametro As DataView, ByVal dv_campo As String, ByVal dg As DataGridView)
        dv_parametro.RowFilter = "parametro='" & dv_campo & "'"
        Dim drx As DataRowView = dv_parametro.Item(0)

        Dim array_valores() As String = Split(drx.Item("valor"), "-")


        Dim ceros As String = ""
        Dim unos As String = ""
        Dim dos As String = ""

        For i As Integer = 0 To UBound(array_valores)
            Dim array_campo() As String = Split(array_valores(i), ",")
            If (array_campo(0) = "0") Then
                ceros += array_valores(i) & "-"
            ElseIf (array_campo(0) = "1") Then
                unos += array_valores(i) & "-"
            ElseIf (array_campo(0) = "2") Then
                dos += array_valores(i) & "-"
            End If
        Next
        ceros.Replace(" ", "")
        unos.Replace(" ", "")
        dos.Replace(" ", "")

        Dim valores_ordenados As String = unos & ceros & dos.Substring(0, dos.Length - 1) '---quitando el ultimo -


        Dim array_valores_ordenados() As String = Split(valores_ordenados, "-")

        Dim array_campos_buscar() As String = {} '--usado para el parametro de buscar
        Dim string_valores_buscar As String = ""
        For j As Integer = 0 To UBound(array_valores_ordenados)
            Dim campo As String = array_valores_ordenados(j)
            'MsgBox(campo)
            Dim array_campo() As String = Split(campo, ",")

            'dg.Columns.Item(array_campo(1)).DisplayIndex = j
            'dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2) & " (" & j & ")"

            If (array_campo(0) = 1) Then
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2) & " (" & j & ")"
                dg.Columns.Item(array_campo(1)).Visible = True

                string_valores_buscar += array_campo(1) & ","
            Else 'ocultando campos 0
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2) & " (" & j & ")"
                dg.Columns.Item(array_campo(1)).Visible = False
            End If
        Next
        campos_tabla = Nothing
        campos_tabla = Split(string_valores_buscar, ",") 'PASANDO CAMPOS PARA BUSQUEDA
        'lista_campos = Nothing
        'lista_campos = Split(string_valores_buscar, ",") 'PASANDO CAMPOS PARA BUSQUEDA

    End Sub

    ''=================== NUEVO ORDENAR CAMPOS GRID y ENVIAR CAMPOS A BUSCADOR ========================================
    '************************************************************************************************
    '********* devuelve lista de CAMPOS PARA BUSCAR - ORDENA EL GRID SEGUN PARAMETRO
    '********* EJEMPLO
    '********* USO:  campos_productos = clases.ordenar_campos2(dv_parametro, "productos", dg_producto) 
    '********* --> se bebe declarar Public campos_productos() As String = {}
    '********* --> dentro de txtcahnged --> clases.buscar_registros(Me.txt_buscar2, dv_producto, dg_producto, campos_productos)
    '********* UBICACION: load FORM
    '******************** ****************************************************************************
    Public Shared Function ordenar_campos2(ByVal dv_parametro As DataView, ByVal dv_campo As String, ByVal dg As DataGridView) As Object
        '---
        Dim campos_ok() As String = {}
        '-------------
        dv_parametro.RowFilter = "parametro='" & dv_campo & "'"
        Dim drx As DataRowView = dv_parametro.Item(0)

        Dim array_valores() As String = Split(drx.Item("valor"), "-") '--SE PASA LOS CAMPOS DE LA TB parametros y los pasa al ARRAY_VALORES  1,nombre,CLIENTE-2,direccion,DIRECCION <--valor de tabla
        '--array_valores contiene (0)=1,nombre,CLIENTE (1)=0,direccion,DIRECCION ,etc 

        Dim ceros As String = "" '--campos ocultos
        Dim unos As String = "" '--campos visibles
        Dim dos As String = "" '--campos fuera de matriz

        For i As Integer = 0 To UBound(array_valores) '---recorre todo el array ORDENANDO EN CADA GRUPO 0 1 2
            Dim array_campo() As String = Split(array_valores(i), ",")
            '--array_campor contiene (0)1 (1) nombre (2) NOMBRE
            If (array_campo(0) = "0") Then
                ceros += array_valores(i) & "-" '--entonces pasa 0,nombre,CLIENTE + "-" a la cadena CEROS
            ElseIf (array_campo(0) = "1") Then
                unos += array_valores(i) & "-"
            ElseIf (array_campo(0) = "2") Then
                dos += array_valores(i) & "-"
            End If
        Next
        ceros.Replace(" ", "")
        unos.Replace(" ", "")
        dos.Replace(" ", "")

        Dim valores_ordenados As String = unos & ceros & dos.Substring(0, dos.Length - 1) '---quitando el ultimo "-" y creando cadena ordenada de campos

        Dim array_valores_ordenados() As String = Split(valores_ordenados, "-")
        '--array_valores_ordenados contiene (0)=1,nombre,CLIENTE (1)=0,direccion,DIRECCION ,etc pero ORDENADOS

        Dim array_campos_buscar() As String = {} '--usado para el parametro de buscar
        Dim string_valores_buscar As String = ""
        For j As Integer = 0 To UBound(array_valores_ordenados)
            Dim campo As String = array_valores_ordenados(j)

            Dim array_campo() As String = Split(campo, ",")

            If (array_campo(0) = 1) Then
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2) & " (" & j & ")"
                dg.Columns.Item(array_campo(1)).Visible = True

                string_valores_buscar += array_campo(1) & "," '--junta los campos que se mostraran y se pasaran al buscador
            Else 'ocultando campos 0 y 2
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2) & " (" & j & ")"
                dg.Columns.Item(array_campo(1)).Visible = False
            End If
        Next
        'campos_tabla = Nothing
        'campos_tabla = Split(string_valores_buscar, ",") 'PASANDO CAMPOS PARA BUSQUEDA

        campos_ok = Nothing
        campos_ok = Split(string_valores_buscar, ",") 'PASANDO CAMPOS PARA BUSQUEDA

        Return campos_ok
    End Function

    ''=================== ORDENAR CAMPOS GRID OBTIENE CAMPOS DE TB PARAMETROS Y NO LE ASIGNA --> (N) ========================================
    Public Shared Sub ordenar_campos_sin_paren(ByVal dv_parametro As DataView, ByVal dv_campo As String, ByVal dg As DataGridView)
        dv_parametro.RowFilter = "parametro='" & dv_campo & "'"
        Dim drx As DataRowView = dv_parametro.Item(0)
        Dim array_valores() As String = Split(drx.Item("valor"), "-")
        Dim ceros As String = ""
        Dim unos As String = ""
        Dim dos As String = ""

        For i As Integer = 0 To UBound(array_valores)
            Dim array_campo() As String = Split(array_valores(i), ",")
            If (array_campo(0) = "0") Then
                ceros += array_valores(i) & "-"
            ElseIf (array_campo(0) = "1") Then
                unos += array_valores(i) & "-"
            ElseIf (array_campo(0) = "2") Then
                dos += array_valores(i) & "-"
            End If
        Next
        ceros.Replace(" ", "")
        unos.Replace(" ", "")
        dos.Replace(" ", "")

        Dim valores_ordenados As String = unos & ceros & dos.Substring(0, dos.Length - 1) '---quitando el ultimo -
        Dim array_valores_ordenados() As String = Split(valores_ordenados, "-")

        Dim array_campos_buscar() As String = {} '--usado para el parametro de buscar
        Dim string_valores_buscar As String = ""
        For j As Integer = 0 To UBound(array_valores_ordenados)
            Dim campo As String = array_valores_ordenados(j)
            Dim array_campo() As String = Split(campo, ",")
            If (array_campo(0) = 1) Then
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2)
                dg.Columns.Item(array_campo(1)).Visible = True
                string_valores_buscar += array_campo(1) & ","
            Else 'ocultando campos 0
                dg.Columns.Item(array_campo(1)).DisplayIndex = j
                dg.Columns.Item(array_campo(1)).HeaderText = array_campo(2)
                dg.Columns.Item(array_campo(1)).Visible = False
            End If
        Next
    End Sub
    '================== TOTAL REGISTROS ========================================
    Public Shared Sub total_registros(ByVal dt As DataTable, ByVal dg As DataGridView, ByVal lb1 As ToolStripLabel, ByVal lb2 As ToolStripLabel, ByVal de As String)
        Dim total_req_ahora As Integer
        Dim total_req As Integer = dt.Rows.Count
        total_req_ahora = dg.Rows.Count
        lb1.Text = "Total de " & de & " = " & total_req
        lb2.Text = de & " Encontradas = " & total_req_ahora
    End Sub

    '================== TOTAL REGISTROS VISTAS ========================================
    Public Shared Sub total_registros_vista(ByVal dv As DataView, ByVal dg As DataGridView, ByVal lb1 As ToolStripLabel, ByVal lb2 As ToolStripLabel, ByVal de As String)
        Dim total_req As Integer = dv.Count
        lb1.Text = "Total de " & de & " = " & total_req
        lb2.Text = ""
    End Sub

    '================== NO ORDENAR CAMPOS GRID ========================================
    Public Shared Sub no_ordenar_grid(ByVal dg As DataGridView)
        For Each dCol In dg.Columns
            dCol.SortMode = DataGridViewColumnSortMode.NotSortable
        Next
    End Sub

    '=================== ESTILOS DE DG ========================================
    Public Shared Sub dg_listas(ByVal dg As DataGridView)
        With dg

            .Dock = DockStyle.Fill
            '.ColumnHeadersVisible = False
            '.AlternatingRowsDefaultCellStyle.BackColor = Color.FromArgb(235, 238, 252)
            '.RowHeadersVisible = False
            .BackgroundColor = Color.WhiteSmoke
            '.AlternatingRowsDefaultCellStyle.BackColor = Color.WhiteSmoke

            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .BorderStyle = BorderStyle.None
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .ReadOnly = True

            .DefaultCellStyle.SelectionBackColor = Color.SteelBlue
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect
            .ColumnHeadersDefaultCellStyle.Font = New Font("Tahoma", 7.0!, FontStyle.Regular)
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.Gray
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            '.DefaultCellStyle.ForeColor = Color.Black
            '.DefaultCellStyle.BackColor = Color.FromArgb(235, 255, 255)
            '.CellBorderStyle = DataGridViewCellBorderStyle.SingleHorizontal
            .DefaultCellStyle.ForeColor = Color.Black
            .DefaultCellStyle.BackColor = Color.White
            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            .MultiSelect = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray
            .RowHeadersWidth = 10
            '.RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)

        End With
    End Sub
    Public Shared Sub dg_detalle(ByVal dg As DataGridView)
        With dg
            .Dock = DockStyle.Fill
            .BorderStyle = BorderStyle.None
            .BackgroundColor = Color.Gainsboro
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .ReadOnly = True
            .MultiSelect = False
            .DefaultCellStyle.SelectionBackColor = Color.MediumVioletRed
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect

            '.ColumnHeadersDefaultCellStyle.Font = New Font("Tahoma", 8.0!, FontStyle.Bold)
            .ColumnHeadersDefaultCellStyle.Font = New Font("Arial Narrow", 7.0!, FontStyle.Bold)
            ''color head camps
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            'color celdas
            '.DefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.DimGray
            .DefaultCellStyle.BackColor = Color.FromArgb(245, 245, 245) 'Color.Gainsboro
            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            'quita lado izq
            '.RowHeadersVisible = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray

            .RowHeadersWidth = 10
            .RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)

        End With
    End Sub
    Public Shared Sub dg_detalle2(ByVal dg As DataGridView)
        With dg
            .Dock = DockStyle.Fill
            .BorderStyle = BorderStyle.None
            .BackgroundColor = Color.Gainsboro
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .ReadOnly = True
            .MultiSelect = False
            .DefaultCellStyle.SelectionBackColor = Color.Navy
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect

            '.ColumnHeadersDefaultCellStyle.Font = New Font("Tahoma", 8.0!, FontStyle.Bold)
            .ColumnHeadersDefaultCellStyle.Font = New Font("Arial Narrow", 7.0!, FontStyle.Bold)
            ''color head camps
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            'color celdas
            '.DefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.DimGray
            .DefaultCellStyle.BackColor = Color.FromArgb(245, 245, 245) 'Color.Gainsboro
            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            'quita lado izq
            '.RowHeadersVisible = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray

            .RowHeadersWidth = 10
            .RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)
        End With
    End Sub

    Public Shared Sub dg_detalle3(ByVal dg As DataGridView)
        With dg
            .Dock = DockStyle.Fill
            .BackgroundColor = Color.WhiteSmoke
            .AlternatingRowsDefaultCellStyle.BackColor = Color.WhiteSmoke

            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .BorderStyle = BorderStyle.None
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .ReadOnly = True
            '.DefaultCellStyle.SelectionBackColor = Color.MediumVioletRed
            '.DefaultCellStyle.SelectionBackColor = Color.Orange
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect
            .ColumnHeadersDefaultCellStyle.Font = New Font("Tahoma", 7.0!, FontStyle.Regular)
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.Gray
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            .DefaultCellStyle.ForeColor = Color.Black
            .DefaultCellStyle.BackColor = Color.White
            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            .MultiSelect = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray

            .RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)

        End With
    End Sub

    Public Shared Sub dg_detalle4(ByVal dg As DataGridView)
        With dg
            .Dock = DockStyle.Fill
            .BorderStyle = BorderStyle.None
            .BackgroundColor = Color.Gainsboro
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .ReadOnly = True
            .MultiSelect = False
            .DefaultCellStyle.SelectionBackColor = Color.ForestGreen
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect

            '.ColumnHeadersDefaultCellStyle.Font = New Font("Tahoma", 8.0!, FontStyle.Bold)
            .ColumnHeadersDefaultCellStyle.Font = New Font("Arial Narrow", 7.0!, FontStyle.Bold)
            ''color head camps
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            'color celdas
            '.DefaultCellStyle.ForeColor = Color.Black
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.DimGray
            .DefaultCellStyle.BackColor = Color.FromArgb(245, 245, 245) 'Color.Gainsboro
            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            'quita lado izq
            '.RowHeadersVisible = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray

            .RowHeadersWidth = 10
            .RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)

        End With
    End Sub

    Public Shared Sub dg_detalle5(ByVal dg As DataGridView)
        With dg
            .Dock = DockStyle.Fill
            .BackgroundColor = Color.WhiteSmoke
            '.AlternatingRowsDefaultCellStyle.BackColor = Color.WhiteSmoke
            .AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
            .BorderStyle = BorderStyle.None
            .EnableHeadersVisualStyles = False
            .AllowUserToResizeRows = False
            .AllowUserToAddRows = False
            .ReadOnly = True
            .DefaultCellStyle.SelectionBackColor = Color.Orange
            .SelectionMode = DataGridViewSelectionMode.FullRowSelect
            .ColumnHeadersDefaultCellStyle.Font = New Font("Arial Narrow", 8.0!, FontStyle.Bold)
            .ColumnHeadersDefaultCellStyle.BackColor = Color.LightGray
            .ColumnHeadersDefaultCellStyle.ForeColor = Color.DimGray
            .ColumnHeadersDefaultCellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter
            .DefaultCellStyle.ForeColor = Color.Black
            .DefaultCellStyle.BackColor = Color.FromArgb(&HEF, &HF6, &HF8)

            .CellBorderStyle = DataGridViewCellBorderStyle.Single
            .MultiSelect = False
            .RowHeadersDefaultCellStyle.BackColor = Color.LightGray

            .RowHeadersWidth = 10
            .RowTemplate.Height = 16
            .DefaultCellStyle.Font = New Font("arial", 7.0!, FontStyle.Regular)

        End With
    End Sub

    '=================== LIMPIAR TEXT ========================================
    Public Shared Sub limpiar_text(ByVal f As Form)
        For Each c As Control In f.Controls
            If TypeOf c Is TextBox Then
                c.Text = ""
            End If
        Next
    End Sub

    Public Shared Sub moverArriba(ByVal Box As ListBox)
        Dim Index As Integer = Box.SelectedIndex
        Dim Swap As Object = Box.SelectedItem
        If (Index <> -1) AndAlso (Index - 1 > -1) Then
            Box.Items.RemoveAt(Index)
            Box.Items.Insert(Index - 1, Swap)
            Box.SelectedItem = Swap
        End If
    End Sub
    Public Shared Sub moverAbajo(ByVal Box As ListBox)
        Dim Index As Integer = Box.SelectedIndex
        Dim Swap As Object = Box.SelectedItem
        If (Index <> -1) AndAlso (Index + 1 < Box.Items.Count) Then
            Box.Items.RemoveAt(Index)
            Box.Items.Insert(Index + 1, Swap)
            Box.SelectedItem = Swap
        End If
    End Sub

    '================== AUTOCOMPLETA COMBOS V 2.0 ========================================
    '---con dataview
    Public Shared Sub autocompleta_combo(ByVal dv As DataView, ByVal cb As ComboBox, ByVal campo As String, Optional ByVal pk As String = "")
        Dim dataCompletion_nom_pro As AutoCompleteStringCollection
        dataCompletion_nom_pro = getDataCompletion_nom_pro(dv, campo)
        With cb
            .DisplayMember = campo
            .ValueMember = pk
            .AutoCompleteMode = AutoCompleteMode.SuggestAppend
            .AutoCompleteSource = AutoCompleteSource.CustomSource
            .AutoCompleteCustomSource = dataCompletion_nom_pro
            .DataSource = dv
        End With
    End Sub
    Public Shared Function getDataCompletion_nom_pro(ByVal dv As DataView, ByVal campo_mostrar As String) As AutoCompleteStringCollection
        Dim col As New AutoCompleteStringCollection
        For Each dr As DataRowView In dv
            col.Add(dr(campo_mostrar).ToString)
        Next
        Return col
    End Function

    '****************************PRODUCTO SELECCIONADO -MOSTRAR EN BARRA*************************
    Public Shared Sub producto_seleccionado(ByVal dg As DataGridView, ByVal lb As ToolStripLabel)
        Try
            Dim row As DataGridViewRow = dg.Rows(dg.CurrentRow.Index)
            lb.Text = row.Cells("producto_nom").Value & " " & row.Cells("descripcion").Value & " " & row.Cells("marca").Value
        Catch ex As Exception

        End Try

    End Sub


    '================== TOTAL REGISTROS DETALLES ========================================
    Public Shared Sub total_registros_detalles(ByVal dg As DataGridView, ByVal lb1 As ToolStripLabel, ByVal de As String)
        Dim total_req As Integer = dg.Rows.Count
        lb1.Text = "Total de " & de & " = " & total_req
    End Sub
    ''================== VERIFICAR SI HAY INERNET ========================================
    'Public Shared Function verificar_si_hay_internet2() As Boolean
    '    Dim objUrl As New System.Uri("http://www.google.com/")
    '    Dim objWebReq As System.Net.WebRequest
    '    objWebReq = System.Net.WebRequest.Create(objUrl)
    '    objWebReq.Timeout = 2000
    '    Dim objResp As System.Net.WebResponse
    '    Try
    '        objResp = objWebReq.GetResponse
    '        objResp.Close()
    '        objWebReq = Nothing
    '        Return True
    '    Catch ex As Exception
    '        objWebReq = Nothing
    '        Return False
    '    End Try
    'End Function

    'Public Shared Function verificar_si_hay_internet() As Boolean
    '    Try
    '        If My.Computer.Network.IsAvailable() Then
    '            If My.Computer.Network.Ping("www.google.com", 500) Then
    '                Return True
    '            Else
    '                Return False
    '            End If
    '        Else
    '            Return False
    '        End If

    '    Catch ex As Exception
    '        Return False
    '    End Try
    'End Function


End Class
