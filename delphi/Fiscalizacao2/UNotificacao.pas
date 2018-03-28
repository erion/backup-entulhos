unit UNotificacao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Mask, wwdbedit, wwSpeedButton, wwDBNavigator,
  ExtCtrls, wwclearpanel, ComCtrls, wwdblook, wwriched, Wwdbdlg;

type
  TfrmNotificacao = class(TForm)
    GroupBox1: TGroupBox;
    StatusBar1: TStatusBar;
    wwDBNavigator1: TwwDBNavigator;
    wwDBNavigator1First: TwwNavButton;
    wwDBNavigator1PriorPage: TwwNavButton;
    wwDBNavigator1Prior: TwwNavButton;
    wwDBNavigator1Next: TwwNavButton;
    wwDBNavigator1NextPage: TwwNavButton;
    wwDBNavigator1Last: TwwNavButton;
    wwDBNavigator1Insert: TwwNavButton;
    wwDBNavigator1Delete: TwwNavButton;
    wwDBNavigator1Edit: TwwNavButton;
    wwDBNavigator1Post: TwwNavButton;
    wwDBNavigator1Cancel: TwwNavButton;
    wwDBNavigator1Refresh: TwwNavButton;
    wwDBNavigator1SaveBookmark: TwwNavButton;
    wwDBNavigator1RestoreBookmark: TwwNavButton;
    GroupBox2: TGroupBox;
    codNotificacao: TwwDBEdit;
    Label1: TLabel;
    Label2: TLabel;
    idDenuncia: TwwDBEdit;
    Label3: TLabel;
    lookupIdFiscal: TwwDBLookupCombo;
    Label4: TLabel;
    lookupIdSituacao: TwwDBLookupCombo;
    Label5: TLabel;
    dataNotificacao: TwwDBEdit;
    Label6: TLabel;
    lookupIdOcorrencia: TwwDBLookupCombo;
    Label7: TLabel;
    lookupCodBaseLegal: TwwDBLookupComboDlg;
    Label8: TLabel;
    observacao: TwwDBRichEdit;
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure FormShow(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
    procedure MostraHint(Sender: TObject);
  end;

var
  frmNotificacao: TfrmNotificacao;

implementation

{$R *.dfm}

uses UdmFiscalizacao, UDenuncia;

procedure TFrmNotificacao.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText:= GetLongHint(Application.Hint);
end;

procedure TfrmNotificacao.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  dmFiscalizacao.qryFiscal.Close;
  dmFiscalizacao.qryDenuncia.Close;
  dmFiscalizacao.qrySituacao.Close;
  dmFiscalizacao.qryOcorrencia.Close;
  dmFiscalizacao.tbNotificacao.Close;

  frmNotificacao := nil;
end;

procedure TfrmNotificacao.FormShow(Sender: TObject);
begin
  frmDenuncia.StatusBar1.SimpleText := '';
  idDenuncia.Text := frmDenuncia.idDenuncia.Text;
  Screen.Cursor := crDefault;
end;

end.
