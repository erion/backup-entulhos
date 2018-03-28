unit UBuscaCidadao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ComCtrls, Grids, Wwdbigrd, Wwdbgrid, StdCtrls, Buttons, ExtCtrls;

type
  TfrmBuscaCidadao = class(TForm)
    Panel1: TPanel;
    SpeedButton1: TSpeedButton;
    edtBuscaCidadao: TEdit;
    wwDBGrid1: TwwDBGrid;
    StatusBar1: TStatusBar;
    procedure SpeedButton1Click(Sender: TObject);
    procedure edtBuscaCidadaoKeyPress(Sender: TObject; var Key: Char);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure wwDBGrid1DblClick(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmBuscaCidadao: TfrmBuscaCidadao;

implementation

uses UdmCadastroFiscalizacao, USolicitacao, UDenuncia;

{$R *.dfm}

procedure TfrmBuscaCidadao.SpeedButton1Click(Sender: TObject);
begin
  if edtBuscaCidadao.Text = '' then
    begin
      ShowMessage('Campo de busca não pode ser nulo!');
    end
  else
    begin
      StatusBar1.SimpleText:= 'Aguarde!... Realizando Busca de Cidadão.';
      Screen.Cursor:= crSqlWait;
      with dmCadastroFiscalizacao.qryBuscaCidadao do
      begin
        Close;
        SQL.Text := 'select cod_cidadao, nome_cidadao from ger_cidadao where UpperCase(nome_cidadao) like ' + QuotedStr(edtBuscaCidadao.Text + '%') + ' order by nome_cidadao';
        Open;
      end;
      Screen.Cursor:= crDefault;
      StatusBar1.SimpleText:= '';
      edtBuscaCidadao.Text:='';
    end;
end;

procedure TfrmBuscaCidadao.edtBuscaCidadaoKeyPress(Sender: TObject;
  var Key: Char);
begin
  if key = #13 then
    begin
      if edtBuscaCidadao.Text = '' then
        begin
          ShowMessage('Campo de busca não pode ser nulo!');
        end
      else
        begin
          StatusBar1.SimpleText:= 'Aguarde!... Realizando Busca de Cidadão.';
          Screen.Cursor:= crSqlWait;
          with dmCadastroFiscalizacao.qryBuscaCidadao do
            begin
              Close;
              SQL.Text := 'select cod_cidadao, nome_cidadao from ger_cidadao where UpperCase(nome_cidadao) like ' + QuotedStr(edtBuscaCidadao.Text + '%') + ' order by nome_cidadao';
              Open;
            end;
          Screen.Cursor:= crDefault;
          StatusBar1.SimpleText:= '';
          edtBuscaCidadao.Text:='';
        end;
    end;
end;

procedure TfrmBuscaCidadao.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  action := cafree;
end;

procedure TfrmBuscaCidadao.wwDBGrid1DblClick(Sender: TObject);
begin
  if infrator = false then
    begin
      frmSolicitacao.LookupIdRequerente.DropDown;
      frmSolicitacao.LookupIdRequerente.Enabled := True;
    end
  else
    begin
      frmDenuncia.LookupIdInfrator.DropDown;
    end;
  frmBuscaCidadao.Close;
end;

end.
