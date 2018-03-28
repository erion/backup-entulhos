unit UVisualizaSolicitacao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Mask, wwdbedit, ExtCtrls, ComCtrls, wwriched;

type
  TfrmVisualizaSolicitacao = class(TForm)
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
    idSolicitacao: TwwDBEdit;
    dataSolicitacao: TwwDBEdit;
    tipoRequerente: TwwDBEdit;
    nomeRequerente: TwwDBEdit;
    assunto: TwwDBEdit;
    origem: TwwDBEdit;
    usuario: TwwDBEdit;
    nmrProtocolo: TwwDBEdit;
    tipoProtocolo: TwwDBEdit;
    dataProtocolo: TwwDBEdit;
    StatusBar1: TStatusBar;
    Label10: TLabel;
    observacao: TwwDBRichEdit;
    procedure FormCreate(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
  private
    { Private declarations }
  public
    { Public declarations }
    procedure MostraHint(Sender: TObject);
  end;

var
  frmVisualizaSolicitacao: TfrmVisualizaSolicitacao;

implementation

uses UdmFiscalizacao;

{$R *.dfm}

procedure TFrmVisualizaSolicitacao.MostraHint(Sender: TObject);
begin
  StatusBar1.SimpleText := GetLongHint(Application.Hint);
end;

procedure TfrmVisualizaSolicitacao.FormCreate(Sender: TObject);
begin
  Application.OnHint := MostraHint;
end;

procedure TfrmVisualizaSolicitacao.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  dmFiscalizacao.qryVisualizaSolicitacao.Close;
  Action := caFree;
end;

end.
