unit UDenuncia;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, wwdblook, ComCtrls, ExtCtrls, Buttons, wwSpeedButton,
  wwDBNavigator, wwclearpanel, ToolWin, Mask, wwdbedit, wwriched;

type
  TfrmDenuncia = class(TForm)
    Panel1: TPanel;
    StatusBar1: TStatusBar;
    LookupIdInfrator: TwwDBLookupCombo;
    LookupIdLogradouro: TwwDBLookupCombo;
    LookupIdBairro: TwwDBLookupCombo;
    LookupIdLotacao: TwwDBLookupCombo;
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
    idDenuncia: TwwDBEdit;
    ToolBar1: TToolBar;
    wwDBNavigator1: TwwDBNavigator;
    wwDBNavigator1First: TwwNavButton;
    wwDBNavigator1PriorPage: TwwNavButton;
    wwDBNavigator1Prior: TwwNavButton;
    wwDBNavigator1Next: TwwNavButton;
    wwDBNavigator1NextPage: TwwNavButton;
    wwDBNavigator1Last: TwwNavButton;
    wwDBNavigator1Insert: TwwNavButton;
    wwDBNavigator1Post: TwwNavButton;
    wwDBNavigator1Cancel: TwwNavButton;
    dataDenuncia: TwwDBEdit;
    assuntoDenuncia: TwwDBEdit;
    SpeedButton1: TSpeedButton;
    descricaoDenuncia: TwwDBRichEdit;
    numero: TwwDBEdit;
    complemento: TwwDBEdit;
    quadra: TwwDBEdit;
    setor: TwwDBEdit;
    lote: TwwDBEdit;
    unidade: TwwDBEdit;
    observacao: TwwDBRichEdit;
    procedure MostraHint(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure SpeedButton1Click(Sender: TObject);
    procedure FormShow(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmDenuncia: TfrmDenuncia;

implementation

{$R *.dfm}

uses UdmFiscalizacao, UBuscaCidadao;

procedure TFrmDenuncia.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText := GetLongHint(Application.Hint);
end;



procedure TfrmDenuncia.FormCreate(Sender: TObject);
begin
  Application.OnHint := MostraHint;
end;

procedure TfrmDenuncia.SpeedButton1Click(Sender: TObject);
begin
  LookupIdInfrator.Hint := '';
  infrator := true;
  Application.CreateForm(TfrmBuscaCidadao, frmBuscaCidadao);
  frmBuscaCidadao.Show;
end;

procedure TfrmDenuncia.FormShow(Sender: TObject);
begin
  dmFiscalizacao.tbDenunciadatahoradenuncia.AsDateTime := Date;
end;

end.
