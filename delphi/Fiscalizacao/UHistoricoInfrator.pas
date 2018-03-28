unit UHistoricoInfrator;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, Grids, Wwdbigrd, Wwdbgrid, ExtCtrls, ComCtrls, StdCtrls,
  wwriched, wwSpeedButton, wwDBNavigator, wwclearpanel, Mask, wwdbedit,
  Buttons, ImgList, ppProd, ppClass, ppReport, ppComm, ppRelatv, ppDB,
  ppDBPipe, ppCtrls, ppVar, ppPrnabl, ppBands, ppCache, ppStrtch, ppMemo,
  ppDBBDE, jpeg;

type
  TfrmHistoricoInfrator = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    infrator: TwwDBEdit;
    CPF: TwwDBEdit;
    CNPJ: TwwDBEdit;
    Panel2: TPanel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label11: TLabel;
    Label12: TLabel;
    Label13: TLabel;
    wwDBNavigator1: TwwDBNavigator;
    wwDBNavigator1Prior: TwwNavButton;
    wwDBNavigator1Next: TwwNavButton;
    idDenuncia: TwwDBEdit;
    situacaoDenuncia: TwwDBEdit;
    dataDenuncia: TwwDBEdit;
    tipoRequerenteDenuncia: TwwDBEdit;
    requerenteDenuncia: TwwDBEdit;
    assuntoDenuncia: TwwDBEdit;
    dataAtendimentoDenuncia: TwwDBEdit;
    descricaoDenuncia: TwwDBRichEdit;
    procedimentosDenuncia: TwwDBRichEdit;
    wwDBNavigator1Button: TwwNavButton;
    ImageList1: TImageList;
    ppReport1: TppReport;
    Panel3: TPanel;
    Panel4: TPanel;
    Label20: TLabel;
    Label23: TLabel;
    codAutoInfracao: TwwDBEdit;
    dataAutoInfracao: TwwDBEdit;
    Panel5: TPanel;
    Label28: TLabel;
    Label32: TLabel;
    codApreensao: TwwDBEdit;
    dataApreensao: TwwDBEdit;
    ppHeaderBand1: TppHeaderBand;
    ppDetailBand1: TppDetailBand;
    ppFooterBand1: TppFooterBand;
    ppLabel1: TppLabel;
    ppLabel2: TppLabel;
    ppLabel3: TppLabel;
    ppSystemVariable1: TppSystemVariable;
    ppSystemVariable2: TppSystemVariable;
    ppLine1: TppLine;
    ppLine5: TppLine;
    ppGroup1: TppGroup;
    ppGroupHeaderBand1: TppGroupHeaderBand;
    ppGroupFooterBand1: TppGroupFooterBand;
    ppLabel5: TppLabel;
    ppLabel6: TppLabel;
    ppLabel7: TppLabel;
    ppLabel8: TppLabel;
    ppLabel9: TppLabel;
    ppLabel10: TppLabel;
    ppLabel11: TppLabel;
    ppLabel12: TppLabel;
    ppLabel13: TppLabel;
    ppDBText1: TppDBText;
    ppDBText2: TppDBText;
    ppLine3: TppLine;
    ppDBText3: TppDBText;
    ppDBText4: TppDBText;
    ppDBText5: TppDBText;
    ppDBText7: TppDBText;
    ppLine6: TppLine;
    ppLine7: TppLine;
    ppLine8: TppLine;
    ppLine9: TppLine;
    ppDBMemo1: TppDBMemo;
    ppDBMemo2: TppDBMemo;
    ppLine15: TppLine;
    ppLabel14: TppLabel;
    ppLabel15: TppLabel;
    ppLabel16: TppLabel;
    ppLine16: TppLine;
    ppDBText8: TppDBText;
    ppDBText9: TppDBText;
    ppLine17: TppLine;
    ppDBText10: TppDBText;
    ppLine19: TppLine;
    ppLine20: TppLine;
    ppLine23: TppLine;
    ppLabel17: TppLabel;
    ppLabel18: TppLabel;
    ppLine22: TppLine;
    ppDBText11: TppDBText;
    ppDBText12: TppDBText;
    ppLine24: TppLine;
    ppLine25: TppLine;
    ppLine28: TppLine;
    ppLabel19: TppLabel;
    ppLabel20: TppLabel;
    ppLine29: TppLine;
    ppDBText13: TppDBText;
    ppDBText14: TppDBText;
    ppLine30: TppLine;
    ppLine31: TppLine;
    ppLine32: TppLine;
    ppLine33: TppLine;
    ppGroup2: TppGroup;
    ppGroupHeaderBand2: TppGroupHeaderBand;
    ppGroupFooterBand2: TppGroupFooterBand;
    ppLabel21: TppLabel;
    ppDBText15: TppDBText;
    ppLabel22: TppLabel;
    ppLabel23: TppLabel;
    ppDBText16: TppDBText;
    ppDBText17: TppDBText;
    ppLine34: TppLine;
    ppSystemVariable3: TppSystemVariable;
    ppDBMemo3: TppDBMemo;
    ppLine35: TppLine;
    ppLine36: TppLine;
    ppLine37: TppLine;
    ppLine38: TppLine;
    ppLine39: TppLine;
    ppLine2: TppLine;
    ppLine4: TppLine;
    ppGroup3: TppGroup;
    ppGroupHeaderBand3: TppGroupHeaderBand;
    ppGroupFooterBand3: TppGroupFooterBand;
    ppLine10: TppLine;
    ppLine11: TppLine;
    ppLine12: TppLine;
    ppLine13: TppLine;
    ppLine14: TppLine;
    ppLine21: TppLine;
    ppLine18: TppLine;
    ppLine26: TppLine;
    ppLine27: TppLine;
    wwDBGrid1: TwwDBGrid;
    ppBDEPipeline2: TppBDEPipeline;
    ppBDEPipeline1: TppBDEPipeline;
    ppImage1: TppImage;
    ppLabel4: TppLabel;
    ppLabel24: TppLabel;
    ppDBPipeline1: TppDBPipeline;
    procedure wwDBNavigator1ButtonClick(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure ppReport1BeforePrint(Sender: TObject);
    procedure ppDBText11GetText(Sender: TObject; var Text: String);
    procedure ppDBText13GetText(Sender: TObject; var Text: String);
    procedure ppDBText8GetText(Sender: TObject; var Text: String);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmHistoricoInfrator: TfrmHistoricoInfrator;
  codInf : integer;

implementation

{$R *.dfm}

uses
  UdmFiscalizacao, ADODB, DB;

procedure TfrmHistoricoInfrator.wwDBNavigator1ButtonClick(Sender: TObject);
begin
with dmFiscalizacao.qryHistoricoInfrator do
  begin
    Close;
    SQL.Text := 'select d.iddenuncia,ci.codinfrator, ci.infrator, ci.cpf, ci.cnpj ' +
        ',d.datahoradenuncia, d.datahoraatendimento, d.assunto ' +
        ',d.descricao, d.procedimentos, s.descricao as situacao ' +
        ',cr.requerente, tr.descricao as tiporequerente, n.codNotificacao ' +
        ',n.dataHoraNotificacao, o.descricao as ocorrencia, a.codAutoinfracao ' +
        ',a.dataHoraInfracao, a.descricao as descricaoInfracao ' +
        ',a.exigencia as exigenciaInfracao, r.codApreensao, r.dataHoraapreensao ' +
        'from fis_denuncia d left join fis_notificacao n on ' +
        '   n.iddenuncia = d.iddenuncia left join fis_ocorrencia o on ' +
        '   o.idOcorrencia = n.idocorrencia left join fis_autoinfracao a on ' +
        '   a.codNotificacao = n.codNotificacao left join fis_registroapreensao r on ' +
        '   r.codNotificacao = n.codNotificacao ' +
        ',  fis_situacao s, fis_solicitacao si, fis_tiporequerente tr ' +
        ',  session.cidadaoInf ci, session.cidadaoReq cr ' +
        'where s.idSituacao = d.idSituacao and ' +
        '  si.idsolicitacao = d.idsolicitacao and ' +
        '  tr.idtiporequerente = si.idtiporequerente and ' +
        '  ci.codinfrator = d.idinfrator and ' +
        '  cr.idsolicitacao = si.idsolicitacao and ' +
        '  ci.iddenuncia = d.iddenuncia and ' +
        '  cr.codrequerente = si.idrequerente and ' +
        '  ci.codInfrator = ' + IntToStr(codInf) +
        ' order by iddenuncia, codnotificacao ';
    Open;
  end;
{
ppDBText8.DataPipeline := ppBDEPipeline1;
ppDBText9.DataPipeline := ppBDEPipeline1;
ppDBText10.DataPipeline := ppBDEPipeline1;
ppDBText11.DataPipeline := ppBDEPipeline1;
ppDBText12.DataPipeline := ppBDEPipeline1;
ppDBText13.DataPipeline := ppBDEPipeline1;
ppDBText14.DataPipeline := ppBDEPipeline1;
}
ppReport1.Print;
end;

procedure TfrmHistoricoInfrator.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  dmFiscalizacao.tbDenuncia.Close;
  dmFiscalizacao.qry.Close;
  dmFiscalizacao.qryHistoricoInfrator.Close;
  dmFiscalizacao.qryHistoricoInfrator2.Close;
  Action := caFree;
end;

procedure TfrmHistoricoInfrator.ppReport1BeforePrint(Sender: TObject);
begin
// Mostra CPF ou CNPJ, dependendo do infrator
if ppDBText16.GetText = '' then
  begin
    ppLabel22.Visible := false;
    ppDBText16.Visible := false;
  end
else
  begin
    ppLabel23.Visible := false;
    ppDBText17.Visible := false;
  end;
end;

procedure TfrmHistoricoInfrator.ppDBText11GetText(Sender: TObject;
  var Text: String);
begin
//deixa visível apenas dados necessários
if Text = '' then
  begin
    ppLine11.Visible := false;
    ppLine12.Visible := false;
    ppLine13.Visible := false;
    ppLine22.Visible := false;
    ppLine24.Visible := false;
    ppLine25.Visible := false;
    ppLabel17.Visible := false;
    ppLabel18.Visible := false;
    ppDBText11.Visible := false;
    ppDBText12.Visible := false;
  end
else
  begin
    ppLine11.Visible := true;
    ppLine12.Visible := true;
    ppLine13.Visible := true;
    ppLine22.Visible := true;
    ppLine24.Visible := true;
    ppLine25.Visible := true;
    ppLabel17.Visible := true;
    ppLabel18.Visible := true;
    ppDBText11.Visible := true;
    ppDBText12.Visible := true;
  end;
end;

procedure TfrmHistoricoInfrator.ppDBText13GetText(Sender: TObject;
  var Text: String);
begin
//deixa visível apenas dados necessários
if Text = '' then
  begin
    ppLine28.Visible := false;
    ppLine29.Visible := false;
    ppLine30.Visible := false;
    ppLine31.Visible := false;
    ppLine32.Visible := false;
    ppLine33.Visible := false;
    ppLabel19.Visible := false;
    ppLabel20.Visible := false;
    ppDBText13.Visible := false;
    ppDBText14.Visible := false;
  end
else
  begin
    ppLine28.Visible := true;
    ppLine29.Visible := true;
    ppLine30.Visible := true;
    ppLine31.Visible := true;
    ppLine32.Visible := true;
    ppLine33.Visible := true;
    ppLabel19.Visible := true;
    ppLabel20.Visible := true;
    ppDBText13.Visible := true;
    ppDBText14.Visible := true;
  end;
end;

procedure TfrmHistoricoInfrator.ppDBText8GetText(Sender: TObject;
  var Text: String);
begin
if Text = '' then
  begin
    ppDBText8.Visible := false;
    ppDBText9.Visible := false;
    ppDBText10.Visible := false;
    ppLine10.Visible := false;
    ppLine14.Visible := false;
    ppLine15.Visible := false;
    ppLine16.Visible := false;
    ppLine17.Visible := false;
    ppLine18.Visible := false;
    ppLine19.Visible := false;
    ppLine20.Visible := false;
    ppLine21.Visible := false;
    ppLine23.Visible := false;
    ppLine26.Visible := false;
    ppLine27.Visible := false;
    ppLabel14.Visible := false;
    ppLabel15.Visible := false;
    ppLabel16.Visible := false;
  end
else
  begin
    ppDBText8.Visible := true;
    ppDBText9.Visible := true;
    ppDBText10.Visible := true;
    ppLine10.Visible := true;
    ppLine14.Visible := true;
    ppLine15.Visible := true;
    ppLine16.Visible := true;
    ppLine17.Visible := true;
    ppLine18.Visible := true;
    ppLine19.Visible := true;
    ppLine20.Visible := true;
    ppLine21.Visible := true;
    ppLine23.Visible := true;
    ppLine26.Visible := true;
    ppLine27.Visible := true;
    ppLabel14.Visible := true;
    ppLabel15.Visible := true;
    ppLabel16.Visible := true;
  end;
end;

end.
