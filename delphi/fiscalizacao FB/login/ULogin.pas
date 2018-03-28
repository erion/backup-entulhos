unit ULogin;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, jpeg, ExtCtrls, StdCtrls, IBQuery, IBDatabase, DB,
  IBCustomDataSet, IBTable, IBSQL;

type
  TForm1 = class(TForm)
    Image1: TImage;
    edtUsuario: TEdit;
    edtSenha: TEdit;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    dbConexao: TIBDatabase;
    IBTransaction1: TIBTransaction;
    qryUsuario: TIBQuery;
    qryUsuarioidUsuario: TIntegerField;
    qryUsuarionome: TIBStringField;
    qryUsuariologin: TIBStringField;
    qryUsuariosenha: TIBStringField;
    procedure edtSenhaKeyPress(Sender: TObject; var Key: Char);
    procedure edtUsuarioExit(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
   end;

var
  Form1: TForm1;

  usuario: Boolean;

implementation

{$R *.dfm}

procedure TForm1.edtSenhaKeyPress(Sender: TObject; var Key: Char);
begin
  if key = #13 then
    begin
      qryUsuario.Close;
      qryUsuario.ParamByName('senha').AsString := edtSenha.Text;
      qryUsuario.Open;
      if qryUsuario.RecordCount = 0 then
        begin
          showmessage('    Senha inválida!    ');
        end
      else
        begin
          if usuario = true then
            ShowMessage('Adefinir o que acontece! Fase de teste.');
        end;

    end;
end;

procedure TForm1.edtUsuarioExit(Sender: TObject);
begin
  qryUsuario.Close;
  qryUsuario.ParamByName('login').AsString := edtUsuario.Text;
  qryUsuario.Open;
  if qryUsuario.RecordCount = 0 then
    begin
      showmessage('Usuário não cadastrado!');
      usuario := true;
    end;
end;

end.
