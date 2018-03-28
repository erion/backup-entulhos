unit UTeste;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ExtCtrls, Registry;

type
  TfrmTeste = class(TForm)
    Label1: TLabel;
    Timer1: TTimer;
    procedure FormShow(Sender: TObject);
    procedure FormKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure Timer1Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmTeste: TfrmTeste;
  cont:integer;

implementation

{$R *.dfm}

procedure AutoInicializa(const TodosUsuarios: boolean = True; const Apaga: boolean = False);
var
  Registro : TRegistry;
begin
  Registro := TRegistry.create;
  try
    Registro.RootKey := byte(TodosUsuarios)+$80000001;
    if Registro.OpenKey('\Software\Microsoft\Windows\CurrentVersion\Run',True) then
      if not Apaga then
        Registro.WriteString(Application.Title,Application.ExeName)
      else
        Registro.DeleteValue(Application.Title);
    Registro.CloseKey;
  finally
    Registro.Free;
  end;
end;

Procedure prcWindowsShutdown;
{===========================================}
{ Autor: Gustavo Zicatti Raimundo }
{ Data: 27/12/2005 }
{ Nome da Procedure: prcWindowsShutdown }
{----------------------------------------------------------------}
{ Objetivos: }
{ Desligar o Windows nas versões 98/2000/XP. }
{ }
{ Observações sobre o access token: }
{ O "access token" ou token de acesso contém informações de segurança sobre }
{ uma sessão de logon do Windows 2000 ou XP. O sistema cria um token cada }
{ vez que um usuário se loga no sistema, e cada processo executado por }
{ este usuário contém uma cópia deste token. O S.O. utiliza este token }
{ para controlar o que o usuário esta acessando, executando ou realizando }
{ dentro do sistema. }
{===========================================}
var
  {Handle para o "access token"}
  hToken: THandle;
  {Privilégio sobre processo}
  tTokenPriv : TTokenPrivileges;
  {Usado apenas para retorno da função AdjustTokenPrivileges}
  dwH: DWORD;
  {Retornos das funções}
  bResult : boolean;
begin
  {Apenas se for Windows 2000 e XP}
  if Win32Platform = VER_PLATFORM_WIN32_NT then
    begin
      {Abre o access token associado ao processo corrente}
      bResult:=OpenProcessToken(GetCurrentProcess, TOKEN_ADJUST_PRIVILEGES, hToken);
      if bResult then
        begin
          {Captura informações sobre o privilégio especificado, "ShutdownPrivilege"}
          bResult:=LookUpPrivilegeValue(nil, 'SeShutdownPrivilege', tTokenPriv.Privileges[0].Luid);
        if bResult then
          begin
            {Define quantidade de entradas para esta funcionalidade}
            tTokenPriv.PrivilegeCount:=1;
            {Define que este processo será habilitado, "PRIVILEGE_ENABLED"}
            tTokenPriv.Privileges[0].Attributes:=SE_PRIVILEGE_ENABLED;
            {Zera retorno da função AdjustTokenPrivileges}
            dwH:=0;
            {Habilita o privilégio definido acima para o access token do processo}
            AdjustTokenPrivileges(hToken, False, tTokenPriv, 0, PTokenPrivileges(nil)^, dwH);
          end;
        {Fecha comunicação com o access token}
        CloseHandle(hToken);
        end;
      {Função para desligar o Windows após acertar os privilégios}
      ExitWindowsEx(EWX_SHUTDOWN or EWX_POWEROFF or EWX_FORCE, 0);
    end
    {Função para desligar o windows sem passar por todos os passos anteriores pois nesta versão não é necessário}
    else
      ExitWindowsEx(EWX_SHUTDOWN or EWX_POWEROFF or EWX_FORCE, 0);
end;

procedure TfrmTeste.FormShow(Sender: TObject);
begin
  EnableMenuItem(GetSystemMenu(handle, False), SC_CLOSE, MF_BYCOMMAND or MF_GRAYED);
  cont := 10;
end;

procedure TfrmTeste.FormKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if Key = VK_MENU then
    Key := 0;
  if Key = VK_F4 then
    Key := 0;
  if Key = VK_F1 then
    Application.Terminate;
end;

procedure TfrmTeste.Timer1Timer(Sender: TObject);
begin
  Label1.caption := 'Desligando ' + IntToStr(cont);
  Dec(cont);
  if cont = 0 then
    prcWindowsShutdown;
end;

end.
