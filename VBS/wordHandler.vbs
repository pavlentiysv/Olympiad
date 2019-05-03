'Обработчик документов word тестами

Set objArgs = Wscript.Arguments
strFileName = objArgs(0)
Set objWA=CreateObject("Word.Application") 
objWA.Visible = True
' "E:/wamp/wamp64/www/Olympiad/db/Tasks/olimp_mat2009.docx"
' Set objWD = objWA.Documents.Add
' Set objSelection = objWA.Selection
' objSelection.TypeText "Testing work"
Dim objWD
Set objWD = objWA.Documents.Open(strFileName)
' Set Sel=objWA.Selection
objWD.Tables(1).Rows(1).Cells(1).Select
Set Sel=objWA.Selection
Sel.Copy
' Sel.MoveRight
Sel.PasteSpecial DataType=3
set Wshshell = WScript.CreateObject("WScript.Shell")
Wshshell.Run "mspaint"
WScript.Sleep 500

WshShell.AppActivate "Paint"
WScript.Sleep 500

WshShell.sendkeys "^(v)"
WScript.Sleep 1500
WshShell.sendkeys "^+(x)"
WScript.Sleep 1000
WshShell.sendkeys "%{F4}"
WScript.Sleep 1500
WshShell.sendkeys "{ENTER}"
WScript.Sleep 1500
WshShell.sendkeys "FileName"+"{ENTER}"
WScript.Sleep 1500

objWA.Quit 0 'wdDoNotSaveChanges
Wscript.Quit 'For exit from script

