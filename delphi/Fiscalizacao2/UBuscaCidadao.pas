unit UBuscaCidadao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ComCtrls, StdCtrls, Buttons, Grids, Wwdbigrd, Wwdbgrid, ExtCtrls;

type
  TfrmBuscaCidadao = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    edtBuscaCidadao: TEdit;
    SpeedButton1: TSpeedButton;
    wwDBGrid1: TwwDBGrid;
    procedure SpeedButton1Click(Sender: TObject);
    procedure wwDBGrid1DblClick(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure edtBuscaCidadaoKeyPress(Sender: TObject; var Key: Char);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmBuscaCidadao: TfrmBuscaCidadao;
  infrator: Boolean;

implementation

uses UdmFiscalizacao2, DB, ADODB, USolicitacao, UDenuncia;

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
      with dmFiscalizacao2.qryCidadao do
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

procedure TfrmBuscaCidadao.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  action := cafree;
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
          with dmFiscalizacao2.qryCidadao do
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

end.
