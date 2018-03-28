unit Ulogin;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, DB, ADODB, Mask;

type
  TfrmLogin = class(TForm)
    edtUser: TEdit;
    Label1: TLabel;
    Label2: TLabel;
    edtSenha: TMaskEdit;
    procedure edtSenhaKeyPress(Sender: TObject; var Key: Char);
  private
    { Private declarations }
  public
    { Public declarations }

    function getUsuario():integer;
    function getLotacao():string;

  end;

var
  frmLogin: TfrmLogin;

implementation

uses UPrincipal, UdmFiscalizacao;

{$R *.dfm}

function TfrmLogin.getUsuario():integer;
begin
  Result := dmFiscalizacao.qryLoginidusuario.Value;
end;

function TfrmLogin.getLotacao():string;
begin
  Result := dmFiscalizacao.qryLogincodlotacao.Value;
end;

procedure TfrmLogin.edtSenhaKeyPress(Sender: TObject; var Key: Char);
begin
  if key = #13 then
  begin
    Screen.Cursor:= crHourGlass;
    with dmfiscalizacao.qryLogin do
    begin
      close;
      Sql.Text:= 'Select * from fis_usuario where login = ''' + edtUser.Text + '''';
      Open;
      If recordcount > 0 then
        begin
          if fieldbyname('senha').AsString = edtSenha.Text then
            begin
              application.CreateForm(TfrmPrincipal, frmPrincipal);
              frmLogin.Hide;
              Screen.Cursor:= crHourGlass;
              frmPrincipal.Show;
            end
            else Showmessage('Senha Inválida')
        end
        else Showmessage('Usuário não cadastrado!');
    end;
  end;
end;

end.
