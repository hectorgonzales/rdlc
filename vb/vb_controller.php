Imports d3Model
Public Class C<?=$objDatos->tbNombreCamello."\n";?>
	Private objGeneral As MGeneral = New MGeneral()
    Private obj<?=$objDatos->tbNombreCamello;?> As M<?=$objDatos->tbNombreCamello;?> = New M<?=$objDatos->tbNombreCamello;?>()

    Public Function listar<?=$objDatos->tbNombreCamello;?>() As DataView
        Dim dv As New DataView
        dv.Table = objGeneral.listarSQL("select * from <?=$objDatos->tbNombreOriginal;?>","<?=$objDatos->tbNombreOriginal;?>")
        Return dv
    End Function

    Public Function insertar<?=$objDatos->tbNombreCamello;?>(obj As M<?=$objDatos->tbNombreCamello;?>) As Integer
        Dim estado As Integer = obj<?=$objDatos->tbNombreCamello;?>.insertar(obj)
		return estado
    End Function

    Public Function modificar<?=$objDatos->tbNombreCamello;?>(pk As Integer) As M<?=$objDatos->tbNombreCamello;?>
    
        Dim obj As M<?=$objDatos->tbNombreCamello;?> = New M<?=$objDatos->tbNombreCamello;?>
        
        obj = obj<?=$objDatos->tbNombreCamello;?>.modificar(pk)
        Return obj
    End Function

    Public Function actualizar<?=$objDatos->tbNombreCamello;?>(obj As M<?=$objDatos->tbNombreCamello;?>) As Integer
        Dim estado As Integer = obj<?=$objDatos->tbNombreCamello;?>.actualizar(obj)
        return estado
    End Function

    Public Function eliminar<?=$objDatos->tbNombreCamello;?>(pk As Integer) As Integer
        Dim estado As Integer = objGeneral.eliminar("<?=$objDatos->tbNombreOriginal;?>","<?=$objDatos->pkTabla;?>",pk)
        return estado
    End Function

End Class