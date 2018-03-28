unit USolicitacao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, wwdblook, Mask, wwdbedit, wwSpeedButton,
  wwDBNavigator, ExtCtrls, wwclearpanel, ComCtrls, wwriched, Wwdbdlg,
  Buttons, Grids, Wwdbigrd, Wwdbgrid, ToolWin, wwdbdatetimepicker,
  wwDialog, wwrcdvw, DB;

type
  TfrmSolicitacao = class(TForm)
    Panel1: TPanel;
    dataSolicitacao: TwwDBEdit;
    idSolicitacao: TwwDBEdit;
    assunto: TwwDBEdit;
    Label7: TLabel;
    Label8: TLabel;
    wwDBRichEdit1: TwwDBRichEdit;
    GroupBox3: TGroupBox;
    wwDBGrid1: TwwDBGrid;
    GroupBox2: TGroupBox;
    Label5: TLabel;
    LookupIdTipoProtocolo: TwwDBLookupCombo;
    Label6: TLabel;
    numProtocolo: TwwDBEdit;
    Label4: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    wwDBGrid1IButton: TwwIButton;
    ToolBar1: TToolBar;
    wwDBNavigator1: TwwDBNavigator;
    wwDBNavigator1Post: TwwNavButton;
    wwDBNavigator1Cancel: TwwNavButton;
    StatusBar1: TStatusBar;
    Label3: TLabel;
    LookupIdOrigem: TwwDBLookupCombo;
    Label1: TLabel;
    LookupIdTipoRequerente: TwwDBLookupCombo;
    Label2: TLabel;
    LookupIdRequerente: TwwDBLookupCombo;
    SpeedButton1: TSpeedButton;
    DTPDataProtocolo: TwwDBDateTimePicker;
    rvdDenuncia: TwwRecordViewDialog;
    dsSolicitacao: TDataSource;
    LookupIdInfrator: TwwDBLookupCombo;
    LookupIdLogradouro: TwwDBLookupCombo;
    LookupIdBairro: TwwDBLookupCombo;
    LookupIdLotacao: TwwDBLookupCombo;
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure FormShow(Sender: TObject);
    procedure LookupIdTipoRequerenteChange(Sender: TObject);
    procedure SpeedButton1Click(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure wwDBGrid1IButtonClick(Sender: TObject);
    procedure dsSolicitacaoStateChange(Sender: TObject);
    procedure rvdDenunciaCloseDialog(Form: TwwRecordViewForm);
    procedure LookupIdOrigemBeforeDropDown(Sender: TObject);
    procedure LookupIdTipoRequerenteBeforeDropDown(Sender: TObject);
    procedure LookupIdTipoProtocoloBeforeDropDown(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
    procedure MostraHint(Sender: TObject);
  end;

var
  frmSolicitacao: TfrmSolicitacao;

implementation

uses UdmFiscalizacao, UPrincipal, UBuscaCidadao, ADODB;

{$R *.dfm}

procedure TFrmSolicitacao.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText := GetLongHint(Application.Hint);
end;

procedure TfrmSolicitacao.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  dmFiscalizacao.tbSolicitacao.Close;
  dmFiscalizacao.qrySolicitacaoRequerente.Close;
  dmFiscalizacao.qrySolicitacaoProtocolo.Close;
  dmFiscalizacao.qrySolicitacaoOrigem.Close;
  dmFiscalizacao.qryDenunciaSolicitacao.Close;
  dmFiscalizacao.qryLogradouro.Close;
  dmFiscalizacao.qryBairro.Close;
  dmFiscalizacao.qryLotacao.Close;
end;

procedure TfrmSolicitacao.FormShow(Sender: TObject);
begin
  frmPrincipal.StatusBar1.SimpleText := '';
  Screen.Cursor := crDefault;
  dmFiscalizacao.tbSolicitacao.Insert;
  dmFiscalizacao.tbSolicitacaodatahorasolicitacao.AsDateTime := Date;
  LookupIdOrigem.SetFocus;
end;

procedure TfrmSolicitacao.LookupIdTipoRequerenteChange(Sender: TObject);
begin
  if LookupIdTipoRequerente.LookupValue = '4' then
      SpeedButton1.Enabled := true
  else
    begin
      LookupIdRequerente.Enabled  := false;
      SpeedButton1.Enabled := false;
    end;
end;

procedure TfrmSolicitacao.SpeedButton1Click(Sender: TObject);
begin
  application.CreateForm(TfrmBuscaCidadao, frmBuscaCidadao);
  frmBuscaCidadao.ShowModal;
end;

procedure TfrmSolicitacao.FormCreate(Sender: TObject);
begin
  Application.OnHint := MostraHint;
end;

procedure TfrmSolicitacao.wwDBGrid1IButtonClick(Sender: TObject);
begin
  StatusBar1.SimpleText := 'Aguarde!... Carregando tabela de denúncia.';
  Screen.Cursor := crHourGlass;
  dmFiscalizacao.tbDenuncia.Open;
  dmFiscalizacao.tbDenuncia.Insert;
  wwDBGrid1.FlushChanges;
  dmFiscalizacao.qryLogradouro.Open;
  dmFiscalizacao.qryBairro.Open;
  dmFiscalizacao.qryLotacao.Open;
  with dmFiscalizacao.qryCidadao do
    begin
      Close;
      SQL.Text := 'select * from ger_cidadao where nome_cidadao <> '''' order by nome_cidadao';
      Open;
    end;
  StatusBar1.SimpleText := '';
  Screen.Cursor := crDefault;
  rvdDenuncia.Execute;
end;

procedure TfrmSolicitacao.dsSolicitacaoStateChange(Sender: TObject);
begin
  wwDBGrid1.Enabled := dsSolicitacao.State in [dsbrowse];
end;

procedure TfrmSolicitacao.rvdDenunciaCloseDialog(Form: TwwRecordViewForm);
begin
  infrator := false;
end;

procedure TfrmSolicitacao.LookupIdOrigemBeforeDropDown(Sender: TObject);
begin
  Screen.Cursor := crHourGlass;
  StatusBar1.SimpleText := 'Aguarde!... Buscando origens.';
  dmFiscalizacao.qrySolicitacaoOrigem.Open;
  LookupIdOrigem.LookupField := 'idorigem';
  Screen.Cursor := crDefault;
  StatusBar1.SimpleText := '';
end;

procedure TfrmSolicitacao.LookupIdTipoRequerenteBeforeDropDown(
  Sender: TObject);
begin
  Screen.Cursor := crHourGlass;
  StatusBar1.SimpleText := 'Aguarde!... Buscando tipos de requerente.';
  dmFiscalizacao.qrySolicitacaoRequerente.Open;
  LookupIdTipoRequerente.LookupField := 'idtiporequerente';
  Screen.Cursor := crDefault;
  StatusBar1.SimpleText := '';
end;

procedure TfrmSolicitacao.LookupIdTipoProtocoloBeforeDropDown(
  Sender: TObject);
begin
  Screen.Cursor := crHourGlass;
  StatusBar1.SimpleText := 'Aguarde!... Buscando tipos de protocolos.';
  dmFiscalizacao.qrySolicitacaoProtocolo.Open;
  LookupIdTipoProtocolo.LookupField := 'idtipoprotocolo';
  Screen.Cursor := crDefault;
  StatusBar1.SimpleText := '';
end;

end.
