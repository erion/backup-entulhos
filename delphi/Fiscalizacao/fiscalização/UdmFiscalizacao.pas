unit UdmFiscalizacao;

interface

uses
  SysUtils, Classes, DB, ADODB, Wwdatsrc, DBTables, Wwquery, Messages;

type
  TdmFiscalizacao = class(TDataModule)
    dbPmnh: TADOConnection;
    qryDenuncia: TADOQuery;
    dsDenuncia: TwwDataSource;
    qryLogin: TADOQuery;
    qryLoginidusuario: TIntegerField;
    qryLogincodlotacao: TStringField;
    qryLoginnome: TStringField;
    qryLoginlogin: TStringField;
    qryLoginsenha: TStringField;
    qryLoginmatricula: TStringField;
    qryDenunciaSolicitacao: TADOQuery;
    tbSolicitacao: TADOTable;
    dsSolicitacao: TwwDataSource;
    tbSolicitacaoidsolicitacao: TIntegerField;
    tbSolicitacaoidtiporequerente: TIntegerField;
    tbSolicitacaoidusuario: TIntegerField;
    tbSolicitacaoidrequerente: TStringField;
    tbSolicitacaoidorigem: TIntegerField;
    tbSolicitacaoidtipoprotocolo: TIntegerField;
    tbSolicitacaonumprotocolo: TStringField;
    tbSolicitacaodataprotocolo: TDateTimeField;
    tbSolicitacaodatahorasolicitacao: TDateTimeField;
    tbSolicitacaoassunto: TStringField;
    tbSolicitacaoobservacao: TMemoField;
    qrySolicitacaoProtocolo: TADOQuery;
    qrySolicitacaoRequerente: TADOQuery;
    qrySolicitacaoRequerentedescricao: TStringField;
    qrySolicitacaoProtocolodescricao: TStringField;
    qrySolicitacaoOrigem: TADOQuery;
    qrySolicitacaoOrigemdescricao: TStringField;
    qrySolicitacaoRequerenteidtiporequerente: TIntegerField;
    qrySolicitacaoOrigemidorigem: TIntegerField;
    qrySolicitacaoProtocoloidtipoprotocolo: TIntegerField;
    tbDenuncia: TADOTable;
    dsCadDenuncia: TwwDataSource;
    tbDenunciaiddenuncia: TIntegerField;
    tbDenunciaidsolicitacao: TIntegerField;
    tbDenunciacodlotacao: TStringField;
    tbDenunciaidfiscal: TIntegerField;
    tbDenunciaidsituacao: TIntegerField;
    tbDenunciaidinfrator: TStringField;
    tbDenunciadatahoradenuncia: TDateTimeField;
    tbDenunciaassunto: TStringField;
    tbDenunciadescricao: TMemoField;
    tbDenunciaprocedimentos: TMemoField;
    tbDenunciadatahoraatendimento: TDateTimeField;
    tbDenunciaobservacao: TMemoField;
    tbDenunciaidbairroinfracao: TIntegerField;
    tbDenunciaidlogradouroinfracao: TIntegerField;
    tbDenuncianumeroinfracao: TStringField;
    tbDenunciacomplementoinfracao: TStringField;
    tbDenunciasetor: TStringField;
    tbDenunciaquadra: TIntegerField;
    tbDenuncialote: TIntegerField;
    tbDenunciaunidade: TStringField;
    qryCidadao: TADOQuery;
    qryCidadaonome_cidadao: TStringField;
    qryCidadaocod_cidadao: TIntegerField;
    qrySituacao: TADOQuery;
    qrySituacaoidsituacao: TIntegerField;
    qrySituacaodescricao: TStringField;
    qryLotacao: TADOQuery;
    qryLotacaocodlotacao: TStringField;
    qryLotacaonome: TStringField;
    qryLogradouro: TADOQuery;
    qryLogradourocod_logradouro: TIntegerField;
    qryLogradourodescricao: TStringField;
    qryBairro: TADOQuery;
    qryBairrocod_bairro: TSmallintField;
    qryBairronome: TStringField;
    tbNotificacao: TADOTable;
    dsNotificacao: TwwDataSource;
    tbNotificacaocodnotificacao: TStringField;
    tbNotificacaoiddenuncia: TIntegerField;
    tbNotificacaoidfiscal: TIntegerField;
    tbNotificacaoidsituacao: TIntegerField;
    tbNotificacaoidocorrencia: TIntegerField;
    tbNotificacaodatahoranotificacao: TDateTimeField;
    tbNotificacaoobservacao: TMemoField;
    tbNotificacaocodbaselegal: TIntegerField;
    dsCidadao: TwwDataSource;
    dsDenunciaSolicitacao: TwwDataSource;
    qry: TADOQuery;
    tbDenunciaNomeInfrator: TStringField;
    tbValoresChave: TADOTable;
    tbValoresChavecampo: TStringField;
    tbValoresChavevalor: TFloatField;
    qryValoresChave: TADOQuery;
    qryValoresChavecampo: TStringField;
    qryValoresChavevalor: TIntegerField;
    tbDenunciaNomeSecretaria: TStringField;
    qryVisualizaSolicitacao: TADOQuery;
    dsVisualizaSolicitacao: TwwDataSource;
    qryHistoricoInfrator: TADOQuery;
    dsHistoricoInfrator: TwwDataSource;
    qryVisualizaSolicitacaoidsolicitacao: TIntegerField;
    qryVisualizaSolicitacaorequerente: TStringField;
    qryVisualizaSolicitacaonome: TStringField;
    qryVisualizaSolicitacaotiporequerente: TStringField;
    qryVisualizaSolicitacaoorigem: TStringField;
    qryVisualizaSolicitacaotipoprotocolo: TStringField;
    qryVisualizaSolicitacaonumprotocolo: TStringField;
    qryVisualizaSolicitacaodataprotocolo: TDateTimeField;
    qryVisualizaSolicitacaodatahorasolicitacao: TDateTimeField;
    qryVisualizaSolicitacaoassunto: TStringField;
    qryVisualizaSolicitacaoobservacao: TMemoField;
    tbSolicitacaoRequerente: TStringField;
    qryDenunciadatahoradenuncia: TDateTimeField;
    qryDenunciaassunto: TStringField;
    qryDenunciarequerente: TStringField;
    qryDenunciainfrator: TStringField;
    qryDenunciaidinfrator: TStringField;
    qryDenunciadescricao: TStringField;
    qryDenunciaiddenuncia: TIntegerField;
    qryDenunciaidsolicitacao: TIntegerField;
    qryHistoricoInfrator2: TADOQuery;
    dsHistoricoInfrator2: TwwDataSource;
    qryHistoricoInfrator2codnotificacao: TStringField;
    qryHistoricoInfrator2datahoranotificacao: TDateTimeField;
    qryHistoricoInfrator2ocorrencianotificacao: TStringField;
    qryHistoricoInfrator2codautoinfracao: TStringField;
    qryHistoricoInfrator2datahorainfracao: TDateTimeField;
    qryHistoricoInfrator2codapreensao: TStringField;
    qryHistoricoInfrator2datahoraapreensao: TDateTimeField;
    qryHistoricoInfratoriddenuncia: TIntegerField;
    qryHistoricoInfratorcodinfrator: TIntegerField;
    qryHistoricoInfratorinfrator: TStringField;
    qryHistoricoInfratorcpf: TStringField;
    qryHistoricoInfratorcnpj: TStringField;
    qryHistoricoInfratordatahoradenuncia: TDateTimeField;
    qryHistoricoInfratordatahoraatendimento: TDateTimeField;
    qryHistoricoInfratorassunto: TStringField;
    qryHistoricoInfratordescricao: TMemoField;
    qryHistoricoInfratorprocedimentos: TMemoField;
    qryHistoricoInfratorsituacao: TStringField;
    qryHistoricoInfratorrequerente: TStringField;
    qryHistoricoInfratortiporequerente: TStringField;
    qryHistoricoInfratorcodnotificacao: TStringField;
    qryHistoricoInfratordatahoranotificacao: TDateTimeField;
    qryHistoricoInfratorocorrencia: TStringField;
    qryHistoricoInfratorcodautoinfracao: TStringField;
    qryHistoricoInfratordatahorainfracao: TDateTimeField;
    qryHistoricoInfratordescricaoinfracao: TStringField;
    qryHistoricoInfratorexigenciainfracao: TStringField;
    qryHistoricoInfratorcodapreensao: TStringField;
    qryHistoricoInfratordatahoraapreensao: TDateTimeField;
    procedure tbSolicitacaoAfterInsert(DataSet: TDataSet);
    procedure tbSolicitacaoAfterCancel(DataSet: TDataSet);
    procedure tbSolicitacaoBeforePost(DataSet: TDataSet);
    procedure tbDenunciaBeforePost(DataSet: TDataSet);
  private
    { Private declarations }

  public
    { Public declarations }

    function getValorCodigo(campo:string): integer;

  end;

var
  dmFiscalizacao: TdmFiscalizacao;

implementation

uses USolicitacao;

{$R *.dfm}

function TdmFiscalizacao.getValorCodigo(campo:string): integer;
begin
{  with qryValoresChave do
  begin
    close;
    Sql.Clear;
    Sql.Text:= 'Update fis_valoreschave set valor = valor + 1 where campo = ' + quotedstr(campo);
    ExecSql;
  end;
  with qryValoresChave do
  begin
    close;
    Sql.Clear;
    Sql.Text:= 'Select * from fis_valoreschave where campo = ' + quotedstr(campo);
    Open;
  end;   }
  With qryValoresChave do
  begin
    Close;
    Parameters.ParamByName('campo').Value:=campo;
    Open;
    Last;
    Edit;
    Fieldbyname('valor').Value:= Fieldbyname('valor').Value + 1;
    Post;
  end;
  Result := qryValoresChave.fieldbyname('valor').Value + 1;
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterInsert(DataSet: TDataSet);
begin
  tbSolicitacaoidusuario.Value := qryLoginidusuario.Value;
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterCancel(DataSet: TDataSet);
begin
  frmSolicitacao.Close;
end;

procedure TdmFiscalizacao.tbSolicitacaoBeforePost(DataSet: TDataSet);
begin
  if dsSolicitacao.State in [dsinsert] then
    tbSolicitacaoidSolicitacao.AsInteger := getValorCodigo('idsolicitacao');
end;

procedure TdmFiscalizacao.tbDenunciaBeforePost(DataSet: TDataSet);
begin
  if dsCaddenuncia.State in [dsinsert] then
    tbDenunciaiddenuncia.AsInteger := getValorCodigo('iddenuncia');
  tbDenunciaidsituacao.AsInteger := 1;
end;

end.
