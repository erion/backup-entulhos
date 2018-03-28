unit USolicitacao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ComCtrls, wwdbdatetimepicker, wwdblook, Wwdbigrd, Grids,
  Wwdbgrid, StdCtrls, wwriched, Mask, wwdbedit, Buttons, ExtCtrls,
  wwSpeedButton, wwDBNavigator, wwclearpanel, ToolWin;

type
  TfrmSolicitacao = class(TForm)
    ToolBar1: TToolBar;
    Panel1: TPanel;
    Label7: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Label3: TLabel;
    Label1: TLabel;
    Label2: TLabel;
    SpeedButton1: TSpeedButton;
    dataSolicitacao: TwwDBEdit;
    idSolicitacao: TwwDBEdit;
    assunto: TwwDBEdit;
    wwDBRichEdit1: TwwDBRichEdit;
    GroupBox3: TGroupBox;
    wwDBGrid1: TwwDBGrid;
    wwDBGrid1IButton: TwwIButton;
    GroupBox2: TGroupBox;
    Label5: TLabel;
    Label6: TLabel;
    Label4: TLabel;
    LookupIdTipoProtocolo: TwwDBLookupCombo;
    numProtocolo: TwwDBEdit;
    DTPDataProtocolo: TwwDBDateTimePicker;
    LookupIdOrigem: TwwDBLookupCombo;
    LookupIdTipoRequerente: TwwDBLookupCombo;
    LookupIdRequerente: TwwDBLookupCombo;
    StatusBar1: TStatusBar;
    wwDBNavigator2: TwwDBNavigator;
    wwDBNavigator2Post: TwwNavButton;
    wwDBNavigator2Cancel: TwwNavButton;
    procedure MostraHint(Sender: TObject);
    procedure LookupIdOrigemBeforeDropDown(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure LookupIdTipoRequerenteBeforeDropDown(Sender: TObject);
    procedure FormShow(Sender: TObject);
    procedure LookupIdTipoProtocoloBeforeDropDown(Sender: TObject);
    procedure LookupIdTipoRequerenteChange(Sender: TObject);
    procedure SpeedButton1Click(Sender: TObject);
    procedure wwDBGrid1IButtonClick(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmSolicitacao: TfrmSolicitacao;
  infrator: boolean;

implementation

{$R *.dfm}

uses UdmCadastroFiscalizacao, DB, ADODB, UBuscaCidadao, UDenuncia;

procedure TFrmSolicitacao.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText := GetLongHint(Application.Hint);
end;

procedure TfrmSolicitacao.LookupIdOrigemBeforeDropDown(Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de origens...';

{
para não dar erro, pois todas as lookup estão em uma mesma qry
}
LookupIdTipoProtocolo.LookupField := '';
LookupIdTipoRequerente.LookupField := '';
LookupIdOrigem.LookupField := '';

  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select * from fis_origem order by descricao';
      Open;
    end;
LookupIdOrigem.LookupField := 'idorigem';
StatusBar1.SimpleText := '';
end;

procedure TfrmSolicitacao.FormCreate(Sender: TObject);
begin
  Application.OnHint := MostraHint;
end;

procedure TfrmSolicitacao.LookupIdTipoRequerenteBeforeDropDown(
  Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de tipos de requerente...';
LookupIdTipoProtocolo.LookupField := '';
LookupIdTipoRequerente.LookupField := '';
LookupIdOrigem.LookupField := '';
  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select * from fis_tiporequerente order by descricao';
      Open;
    end;
LookupIdTipoRequerente.LookupField := 'idtiporequerente';
StatusBar1.SimpleText := '';
end;

procedure TfrmSolicitacao.FormShow(Sender: TObject);
begin
  dmCadastroFiscalizacao.tbSolicitacao.Open;
  dmCadastroFiscalizacao.tbSolicitacao.insert;
  dataSolicitacao.SetFocus;
  dmCadastroFiscalizacao.tbSolicitacaodatahorasolicitacao.Value := Date;
end;

procedure TfrmSolicitacao.LookupIdTipoProtocoloBeforeDropDown(
  Sender: TObject);
begin
StatusBar1.SimpleText := 'Aguarde! Efetuando busca de tipos de protocolo...';
LookupIdTipoProtocolo.LookupField := '';
LookupIdTipoRequerente.LookupField := '';
LookupIdOrigem.LookupField := '';
  with dmCadastroFiscalizacao.qryLookup do
    begin
      Close;
      SQL.Text := 'select * from fis_tipoprotocolo order by descricao';
      Open;
    end;
LookupIdTipoProtocolo.LookupField := 'idtipoprotocolo';
StatusBar1.SimpleText := '';
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
infrator := false;
  Application.CreateForm(TfrmBuscaCidadao,frmBuscaCidadao);
  frmBuscaCidadao.ShowModal;
end;

procedure TfrmSolicitacao.wwDBGrid1IButtonClick(Sender: TObject);
begin
  dmCadastroFiscalizacao.tbDenuncia.Open;
  Application.CreateForm(TfrmDenuncia, frmDenuncia);
  frmDenuncia.ShowModal;
end;

end.
