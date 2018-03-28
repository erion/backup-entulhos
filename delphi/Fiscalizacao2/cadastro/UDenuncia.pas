unit UDenuncia;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ComCtrls, StdCtrls, wwriched, Mask, wwdbedit, wwdblook, Buttons,
  ExtCtrls, wwSpeedButton, wwDBNavigator, wwclearpanel, ToolWin;

type
  TfrmDenuncia = class(TForm)
    ToolBar1: TToolBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Label11: TLabel;
    Label12: TLabel;
    Label13: TLabel;
    Label14: TLabel;
    Label15: TLabel;
    SpeedButton1: TSpeedButton;
    LookupIdInfrator: TwwDBLookupCombo;
    LookupIdLogradouro: TwwDBLookupCombo;
    LookupIdBairro: TwwDBLookupCombo;
    LookupIdLotacao: TwwDBLookupCombo;
    idDenuncia: TwwDBEdit;
    dataDenuncia: TwwDBEdit;
    assuntoDenuncia: TwwDBEdit;
    descricaoDenuncia: TwwDBRichEdit;
    numero: TwwDBEdit;
    complemento: TwwDBEdit;
    quadra: TwwDBEdit;
    setor: TwwDBEdit;
    lote: TwwDBEdit;
    unidade: TwwDBEdit;
    observacao: TwwDBRichEdit;
    StatusBar1: TStatusBar;
    wwDBNavigator1: TwwDBNavigator;
    wwDBNavigator1Insert: TwwNavButton;
    wwDBNavigator1Post: TwwNavButton;
    wwDBNavigator1Cancel: TwwNavButton;
    procedure SpeedButton1Click(Sender: TObject);
    procedure LookupIdLotacaoBeforeDropDown(Sender: TObject);
    procedure LookupIdLogradouroBeforeDropDown(Sender: TObject);
    procedure LookupIdBairroBeforeDropDown(Sender: TObject);
    procedure FormShow(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure FormCreate(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }

    procedure MostraHint(Sender: TObject);

  end;

var
  frmDenuncia: TfrmDenuncia;

implementation

{$R *.dfm}

uses UdmCadastroFiscalizacao, UBuscaCidadao, USolicitacao, DB, ADODB;

procedure TFrmDenuncia.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText := GetLongHint(Application.Hint);
end;

procedure TfrmDenuncia.SpeedButton1Click(Sender: TObject);
begin
  infrator := true;
  Application.CreateForm(TfrmBuscaCidadao,frmBuscaCidadao);
  frmBuscaCidadao.ShowModal;
end;

procedure TfrmDenuncia.LookupIdLotacaoBeforeDropDown(Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de lotação...';
LookupIdLotacao.LookupField := '';
LookupIdLogradouro.LookupField := '';
LookupIdBairro.LookupField := '';
frmSolicitacao.LookupIdTipoProtocolo.LookupField := '';
frmSolicitacao.LookupIdTipoRequerente.LookupField := '';
frmSolicitacao.LookupIdOrigem.LookupField := '';
  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select * from fis_lotacao order by nome';
      Open;
    end;
LookupIdLotacao.LookupField := 'codlotacao';
StatusBar1.SimpleText := '';
end;

procedure TfrmDenuncia.LookupIdLogradouroBeforeDropDown(Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de logradouro...';
LookupIdLotacao.LookupField := '';
LookupIdLogradouro.LookupField := '';
LookupIdBairro.LookupField := '';
frmSolicitacao.LookupIdTipoProtocolo.LookupField := '';
frmSolicitacao.LookupIdTipoRequerente.LookupField := '';
frmSolicitacao.LookupIdOrigem.LookupField := '';
  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select cod_logradouro, descricao from ger_logradouro order by descricao';
      Open;
    end;
LookupIdLogradouro.LookupField := 'cod_logradouro';
StatusBar1.SimpleText := '';
end;

procedure TfrmDenuncia.LookupIdBairroBeforeDropDown(Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de bairro...';
LookupIdLotacao.LookupField := '';
LookupIdLogradouro.LookupField := '';
LookupIdBairro.LookupField := '';
frmSolicitacao.LookupIdTipoProtocolo.LookupField := '';
frmSolicitacao.LookupIdTipoRequerente.LookupField := '';
frmSolicitacao.LookupIdOrigem.LookupField := '';
  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select * from ger_bairro order by nome';
      Open;
    end;
LookupIdBairro.LookupField := 'cod_bairro';
StatusBar1.SimpleText := '';
end;

procedure TfrmDenuncia.FormShow(Sender: TObject);
begin
  dmCadastroFiscalizacao.tbDenuncia.Insert;
  dmCadastroFiscalizacao.tbDenunciadatahoradenuncia.Value := Date;
end;

procedure TfrmDenuncia.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  dmCadastroFiscalizacao.tbDenuncia.Close;
  Action := caFree;
end;

procedure TfrmDenuncia.FormCreate(Sender: TObject);
begin
  Application.OnHint := MostraHint;
end;

end.
